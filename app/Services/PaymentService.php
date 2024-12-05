<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\TariffGroup;
use App\Models\RecordMeter;
use App\Models\Bill;
use App\Models\Payment;

class PaymentService
{
    public function createPayment($customerCode)
    {
        $company = auth()->user()->company; 
        
        $customer = Customer::where('customer_code', $customerCode)->firstOrFail();
        $tariffGroup = TariffGroup::find($customer->group_id);
        $recordMeter = RecordMeter::where('customer_id', $customer->id)->latest()->firstOrFail();
        $bill = Bill::where('record_meter_id', $recordMeter->id)->firstOrFail();

        $payment = new Payment();
        $payment->customer_id = $customer->customer_code;
        $payment->name = $customer->name;
        $payment->group_name = $tariffGroup->group_name;
        $payment->record_meter_id = $recordMeter->id;
        $payment->date = $recordMeter->date;
        $payment->last_meter = $recordMeter->last_meter;
        $payment->current_meter = $recordMeter->current_meter;
        $payment->usage_amount = $bill->usage_amount;
        $payment->total_bill = $bill->total_bill;
        $payment->retribution = $company->retribution;
        $payment->fines = $company->fines;
        $payment->total_payment = $bill->total_bill + $company->retribution + $company->fines;
        $payment->save();

        return $payment;
    }
}
