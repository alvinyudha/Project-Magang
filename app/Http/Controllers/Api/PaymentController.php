<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function getPaymentData(Request $request)
    {
        $customerCode = $request->query('customer_code');

        if (!$customerCode) {
            return response()->json(['message' => 'Customer code is required'], 400);
        }

        // If customer_code is 'all', fetch data for all customers
        if ($customerCode === 'all') {
            $customers = Customer::with(['tariffGroup', 'user', 'tariffCategory'])->get();

            if ($customers->isEmpty()) {
                return response()->json(['message' => 'No customers found'], 404);
            }

            $data = [];

            foreach ($customers as $customer) {
                $recordMeters = DB::table('customers')
                                ->join('record_meters', 'customers.id_customer', '=', 'record_meters.id_customer')
                                ->select('record_meters.*')
                                ->where('customers.customer_code', $customer->customer_code)
                                ->orderBy('record_meters.created_at', 'desc') // Order by creation date descending
                                ->get();

                $bills = DB::table('customers')
                            ->join('bills', 'customers.id_customer', '=', 'bills.customer_id')
                            ->select('bills.*')
                            ->where('customers.customer_code', $customer->customer_code)
                            ->where('bills.status', 'unpaid') // Only unpaid bills
                            ->get();

                // Skip if no unpaid bills
                if ($bills->isEmpty()) {
                    continue;
                }

                $usageAmount = $bills->sum('usage_amount');
                $totalBill = $bills->sum('total_bill');
                $companyId = $customer->company_id;
                $company = Company::find($companyId);

                $retribution = $company->retribution ?? 0;
                $finesPerPeriod = $company->fines ?? 0;
                $totalFines = 0;
                $totalPayment = $totalBill + $retribution;

                $currentDate = Carbon::now();
                $periods = [];
                foreach ($recordMeters as $meter) {
                    $relatedBill = $bills->firstWhere('record_meter_id', $meter->id);
                    if ($relatedBill && $relatedBill->status === 'unpaid') {
                        $period = Carbon::parse($meter->date)->format('F Y');
                        if (!in_array($period, $periods)) {
                            $periods[] = $period;
                            $billDate = Carbon::parse($relatedBill->created_at);
                            $monthsOverdue = $currentDate->diffInMonths($billDate);
                            if ($monthsOverdue >= 1) {
                                $totalFines += $finesPerPeriod * $monthsOverdue;
                            }
                        }
                    }
                }

                $totalPayment += $totalFines;

                $lastBill = $bills->first();
                $lastMeter = $lastBill ? $lastBill->last_meter : null;
                $currentBill = $bills->last();
                $currentMeter = $currentBill ? $currentBill->current_meter : null;

                $data[] = [
                    'customer' => [
                        'name' => $customer->name,
                        'customer_code' => $customer->customer_code,
                        'group_name' => $customer->tariffCategory->group_name,
                    ],
                    'record_meter' => $recordMeters ?? null,
                    'periods' => $periods,
                    'last_meter' => $lastMeter ?? null,
                    'current_meter' => $currentMeter ?? null,
                    'bills' => $bills,
                    'usage_amount' => $usageAmount,
                    'total_bill' => $totalBill,
                    'company' => [
                        'retribution' => $retribution,
                        'fines' => $finesPerPeriod,
                        'total_fines' => $totalFines,
                    ],
                    'total_payment' => $totalPayment,
                ];
            }

            return response()->json($data);
        }

        // Existing code for fetching data for a specific customer
        $customer = Customer::where('customer_code', $customerCode)->first();

        if (!$customer) {
            $customer = Customer::with(['tariffGroup', 'user', 'tariffCategory'])
                ->where('name', $customerCode)
                ->first();

            if (!$customer) {
                return response()->json(['message' => 'Customer not found'], 404);
            }
        }

        $recordMeters = DB::table('customers')
                        ->join('record_meters', 'customers.id_customer', '=', 'record_meters.id_customer')
                        ->select('record_meters.*')
                        ->where('customers.customer_code', $customer->customer_code)
                        ->orderBy('record_meters.created_at', 'desc') // Order by creation date descending
                        ->get();

        $bills = DB::table('customers')
                    ->join('bills', 'customers.id_customer', '=', 'bills.customer_id')
                    ->select('bills.*')
                    ->where('customers.customer_code', $customer->customer_code)
                    ->where('bills.status', 'unpaid') // Only unpaid bills
                    ->get();

        if ($bills->isEmpty() || $bills->sum('total_bill') == 0) {
            return response()->json(['message' => 'Tagihan sudah dibayar'], 200);
        }

        $usageAmount = $bills->sum('usage_amount');
        $totalBill = $bills->sum('total_bill');
        $companyId = $customer->company_id;
        $company = Company::find($companyId);

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        $retribution = $company->retribution ?? 0;
        $finesPerPeriod = $company->fines ?? 0;
        $totalFines = 0;
        $totalPayment = $totalBill + $retribution;

        $currentDate = Carbon::now();
        $periods = [];
        foreach ($recordMeters as $meter) {
            $relatedBill = $bills->firstWhere('record_meter_id', $meter->id);
            if ($relatedBill && $relatedBill->status === 'unpaid') {
                $period = Carbon::parse($meter->date)->format('F Y');
                if (!in_array($period, $periods)) {
                    $periods[] = $period;
                    $billDate = Carbon::parse($relatedBill->created_at);
                    $monthsOverdue = $currentDate->diffInMonths($billDate);
                    if ($monthsOverdue >= 1) {
                        $totalFines += $finesPerPeriod * $monthsOverdue;
                    }
                }
            }
        }

        $totalPayment += $totalFines;

        $lastBill = $bills->first();
        $lastMeter = $lastBill ? $lastBill->last_meter : null;
        $currentBill = $bills->last();
        $currentMeter = $currentBill ? $currentBill->current_meter : null;

        return response()->json([
            'customer' => [
                'name' => $customer->name,
                'customer_code' => $customer->customer_code,
                'group_name' => $customer->tariffCategory->group_name,
            ],
            'record_meter' => $recordMeters ?? null,
            'periods' => $periods,
            'last_meter' => $lastMeter ?? null,
            'current_meter' => $currentMeter ?? null,
            'bills' => $bills,
            'usage_amount' => $usageAmount,
            'total_bill' => $totalBill,
            'company' => [
                'retribution' => $retribution,
                'fines' => $finesPerPeriod,
                'total_fines' => $totalFines,
            ],
            'total_payment' => $totalPayment,
        ]);
    }

    public function create(Request $request)
    {
        $customerCode = $request->input('customer_code');

        if (!$customerCode) {
            return ResponseFormatter::error('Harap masukkan kode pelanggan', null, 400);
        }

        $customer = Customer::where('customer_code', $customerCode)->first();

        if (!$customer) {
            return ResponseFormatter::error('Pelanggan tidak ditemukan', null, 404);
        }

        // Ambil data dari tabel record meter menggunakan join
        $recordMeter = DB::table('customers')
                        ->join('record_meters', 'customers.id_customer', '=', 'record_meters.id_customer')
                        ->select('record_meters.*')
                        ->where('customers.customer_code', $customerCode)
                        ->get();

        // Mengambil tanggal dari record meter dan menyaring tanggal unik
        $dates = [];
        foreach ($recordMeter as $meter) {
            $dates[] = $meter->date;
        }
        $uniqueDates = array_unique($dates);

        // Mengonversi tanggal-tanggal unik ke format 'F Y'
        $bills = DB::table('customers')
                    ->join('bills', 'customers.id_customer', '=', 'bills.customer_id')
                    ->select('bills.*')
                    ->where('customers.customer_code', $customer->customer_code)
                    ->where('bills.status', 'unpaid')
                    ->get();

        $periods = [];
        foreach ($recordMeter as $meter) {
            $relatedBill = $bills->firstWhere('record_meter_id', $meter->id);
            if ($relatedBill && $relatedBill->status === 'unpaid') {
                $period = Carbon::parse($meter->date)->format('F Y'); 
                if (!in_array($period, $periods)) {
                    $periods[] = $period;
                }
            }
        }

        // Mengonversi array $periods menjadi string dengan menggunakan implode()
        $periodsString = implode(', ', $periods);

        // Ambil data dari tabel tagihan menggunakan join
        $bills = DB::table('customers')
                    ->join('bills', 'customers.id_customer', '=', 'bills.customer_id')
                    ->select('bills.*')
                    ->where('customers.customer_code', $customerCode)
                    ->where('bills.status', 'unpaid')
                    ->orderBy('bills.created_at', 'asc')
                    ->get();
        
        $usageAmount = $bills->sum('usage_amount');
        $totalBill = $bills->sum('total_bill');

        $companyId = $customer->company_id;

        $company = Company::find($companyId);

        if (!$company) {
            return ResponseFormatter::error('Perusahaan tidak ditemukan', null, 404);
        }

        $retribution = $company->retribution ?? 0;
        $fines = $company->fines ?? 0;
        $totalPayment = $totalBill + $retribution;

        $currentDate = Carbon::now();
        if ($currentDate->day > 20) {
            $totalPayment += $fines;
        } else {
            $fines = null;     
        }

        $lastBill = $bills->first();
        $lastMeter = $lastBill ? $lastBill->last_meter : null;

        $currentBill = $bills->last();
        $currentMeter = $currentBill ? $currentBill->current_meter : null;

        $payment = Payment::create([
            'customer_id' => $customer->id_customer,
            'name' => $customer->name,
            'group_name' => $customer->tariffCategory->group_name,
            'period' => $periodsString,
            'last_meter' => $lastMeter,
            'current_meter' => $currentMeter,
            'usage_amount' => $usageAmount,
            'total_bill' => $totalBill,
            'retribution' => $retribution,
            'fines' => $fines,
            'total_payment' => $totalPayment,
            'payment_date' => Carbon::now(),
        ]);

        DB::table('bills')
        ->join('customers', 'customers.id_customer', '=', 'bills.customer_id')
        ->where('customers.customer_code', $customerCode)
        ->where('bills.status', 'unpaid')
        ->update(['bills.status' => 'paid']);

        return ResponseFormatter::success(
            [
                'payment' => $payment,
                'message' => 'Sukses melakukan pembayaran'
            ],
            'Sukses melakukan pembayaran'
        );
    }
}
