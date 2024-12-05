<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\RecordMeter;
use App\Models\TariffCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BillController extends Controller
{
    public function index()
    {
        $userID = auth()->user()->id;
        $bill =  DB::table('bills')
            ->join('record_meters', 'record_meters.id', '=', 'bills.record_meter_id')
            ->join('customers', 'customers.id_customer', '=', 'bills.customer_id')
            ->select('record_meters.current_meter AS current_meters', 'record_meters.last_meter AS last_meters', 'customers.name AS name', 'bills.*')
            ->where('bills.user_id', '=', $userID)
            ->get();
        return view('pages.superadmin.bills.index', compact('bill'));
    }
    public function approve(Request $request, $id)
    {
        $bill = Bill::findOrFail($id);
        $bill->update(['status' => 'paid']);
        $bill->save();
        // Masukkan data yang berstatus "paid" ke dalam tabel "payment"
        if ($bill->status === 'paid') {
            $customer = Customer::find($bill->customer_id);
            $tariffGroup = TariffCategory::find($customer->group_id);
            $recordMeter = RecordMeter::find($bill->record_meter_id);
            $company = Company::find($customer->company_id);
            $retribution = floatval($company->retribution);
            $totalBill = floatval($bill->total_bill);
            $totalPayment = $retribution + $totalBill;

            $payment = new Payment();
            $payment->customer_id = $bill->customer_id;
            $payment->customer_code = $customer->customer_code;
            $payment->name = $customer->name;
            $payment->group_name = $tariffGroup->group_name;
            $payment->bill_id = $bill->id;
            $payment->usage_amount = $bill->usage_amount;
            $payment->total_bill = $totalBill;
            $payment->retribution = $company->retribution;
            $payment->fines = $company->fines;
            $payment->total_payment = $totalPayment;
            $payment->status = $bill->status;
            $payment->last_meter = $bill->last_meter;
            $payment->current_meter = $bill->current_meter;
            $payment->period = $recordMeter->date;
            $payment->payment_date = Carbon::now();
            $payment->user_id = $bill->user_id;
            $payment->save();
        }

        return redirect()->back()->with('success', 'Status Telah Berubah');
    }
}
