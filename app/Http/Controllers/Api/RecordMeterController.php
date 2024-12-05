<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\RecordMeter;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecordMeterController extends Controller
{
    public function index(Request $request)
    {
        $customerCode = $request->input('customer_code');
        $limit = $request->input('limit', 10);

        if ($customerCode == "all") {
            $subQuery = DB::table('record_meters as rm1')
            ->select('rm1.id')
            ->whereRaw('rm1.id = (SELECT rm2.id FROM record_meters as rm2 WHERE rm2.id_customer = rm1.id_customer ORDER BY rm2.date DESC LIMIT 1)');

            $recordMeters = RecordMeter::with('customer')
            ->whereIn('id', $subQuery)
            ->orderBy('date', 'desc')
            ->paginate($limit);

            return ResponseFormatter::success(
                $recordMeters,
                'Data record meter berhasil diambil'
            );
        } elseif ($customerCode) {
            $customer = Customer::with(['tariffGroup', 'user', 'tariffCategory'])
                ->where('customer_code', $customerCode)
                ->orWhere('name', $customerCode)
                ->first();

            if ($customer) {
                $customerId = $customer->id_customer;
                $recordMeters = RecordMeter::with('customer')
                    ->where('id_customer', $customerId)
                    ->orderBy('date', 'desc')
                    ->paginate($limit);

                if ($recordMeters->isEmpty()) {
                    return ResponseFormatter::success(
                        ['customer' => $customer, 'recordMeters' => [], 'message' => 'Belum ada data Record Meter'],
                        'Data customer berhasil diambil'
                    );
                }

                return ResponseFormatter::success(
                    ['customer' => $customer, 'recordMeters' => $recordMeters],
                    'Data customer dan catat meter berhasil diambil'
                );
            } else {
                return ResponseFormatter::error('Customer tidak ditemukan.', 404);
            }
        } else {
            return ResponseFormatter::error(
                null,
                'Data tidak ada',
                404
            );
        }
    }

    public function create(Request $request)
    {
        $request->validate([
            'customer_code' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Customer::where('customer_code', $value)->orWhere('name', $value)->exists()) {
                        $fail('Customer tidak ditemukan.');
                    }
                },
            ],
            'current_meter' => 'required|numeric',
        ]);

        // Ambil data pelanggan berdasarkan kode pelanggan atau nama pelanggan
        $customer = Customer::with(['tariffGroup', 'user', 'tariffCategory'])
            ->where('customer_code', $request->customer_code)
            ->orWhere('name', $request->customer_code)
            ->first();

        if (!$customer) {
            return ResponseFormatter::error('Customer tidak ditemukan.', 404);
        }

        $customerId = $customer->id_customer;

        // Ambil tanggal terakhir catatan meter untuk pelanggan tersebut
        $lastRecordMeter = RecordMeter::where('id_customer', $customerId)
            ->orderBy('date', 'desc')
            ->first();

        // Jika terdapat catatan meter sebelumnya
        if ($lastRecordMeter !== null) {
            // Periksa apakah nilai current_meter lebih rendah dari nilai sebelumnya
            if ($request->current_meter < $lastRecordMeter->current_meter) {
                return ResponseFormatter::error('Input nomor meter tidak boleh lebih rendah dari nilai sebelumnya.', 422);
            }

            $lastRecordDate = Carbon::createFromFormat('Y-m-d', $lastRecordMeter->date);

            // Periksa apakah tanggal yang dimasukkan lebih kecil atau sama dengan tanggal terakhir catatan meter
            if (Carbon::now('Asia/Jakarta')->format('Y-m-d') <= $lastRecordDate->format('Y-m-d')) {
                return ResponseFormatter::error('Catat Meter sudah dilakukan.', 422);
            }
        }

        // Ambil bulan dan tahun dari tanggal yang diberikan
        $recordMonth = Carbon::now('Asia/Jakarta')->format('Y-m');

        // Periksa apakah sudah ada catatan meter untuk pelanggan yang sama pada bulan yang sama
        $existingRecordMeter = RecordMeter::where('id_customer', $customerId)
            ->where(DB::raw('DATE_FORMAT(date, "%Y-%m")'), $recordMonth)
            ->exists();

        if ($existingRecordMeter) {
            return ResponseFormatter::error('Catat Meter periode ini sudah dilakukan.', 422);
        }

        // Ambil nilai current_meter terakhir dari catatan meter customer
        $lastMeter = $lastRecordMeter ? $lastRecordMeter->current_meter : 0;

        // Hitung nilai tambahan dari current_meter
        $additionalMeter = $request->current_meter - $lastMeter;

        $user = Auth::user();
        $userId = $user->created_by;

        // Buat catatan meter baru dengan nilai last_meter yang diperoleh dan tambahan nilai dari current_meter
        $recordMeter = RecordMeter::create([
            'id_customer' => $customerId,
            'date' => Carbon::now('Asia/Jakarta')->format('Y-m-d'),
            'last_meter' => $lastMeter,
            'current_meter' => $request->current_meter,
            'additional_meter' => $additionalMeter,
            'meter_photos' => $request->meter_photos,
            'user_id' => $userId,
        ]);

        // Panggil fungsi untuk membuat tagihan setelah pembuatan catatan meter
        $this->createBill($customer->customer_code, $recordMeter->id, $userId);

        return ResponseFormatter::success($recordMeter, 'Catat meter berhasil dibuat', 201);
    }

    private function createBill($customerCode, $recordMeterId, $userId)
    {
        // Ambil ID pelanggan berdasarkan customer_code atau name
        $customer = Customer::where('customer_code', $customerCode)
            ->orWhere('name', $customerCode)
            ->first();

        if (!$customer) {
            return ResponseFormatter::error('Customer tidak ditemukan.', 404);
        }

        $customerId = $customer->id_customer;
        $recordMeter = RecordMeter::find($recordMeterId);

        $usage_amount = $this->calculateUsageAmount($recordMeterId);
        $total_bill = $this->calculateTotalBill($customerCode, $usage_amount); 

        Bill::create([
            'customer_id' => $customerId,
            'record_meter_id' => $recordMeterId,
            'user_id' => $userId, 
            'last_meter' => $recordMeter->last_meter,
            'current_meter' => $recordMeter->current_meter,
            'usage_amount' => $usage_amount,
            'total_bill' => $total_bill,
            'printed' => true,
        ]);
    }

    private function calculateUsageAmount($recordMeterId)
    {
        // Retrieve the record meter by its ID
        $recordMeter = RecordMeter::findOrFail($recordMeterId);

        // Calculate the usage amount
        $usageAmount = $recordMeter->current_meter - $recordMeter->last_meter;

        return $usageAmount;
    }

    private function calculateTotalBill($customerCode, $usage_amount)
    {
        // Ambil data pelanggan berdasarkan customer_code atau name
        $customer = Customer::with('tariffCategory')
            ->where('customer_code', $customerCode)
            ->orWhere('name', $customerCode)
            ->first();

        if (!$customer) {
            return ResponseFormatter::error('Customer tidak ditemukan.', 404);
        }

        // Ambil informasi tarif
        $tariff = $customer->tariffCategory->tariff;
        $total_bill = $usage_amount * $tariff;

        return $total_bill;
    }
}
