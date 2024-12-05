<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'name',
        'group_name',
        'record_meter_id',
        'period',
        'last_meter',
        'current_meter',
        'bill_id',
        'usage_amount',
        'total_bill',
        'retribution',
        'fines',
        'total_payment',
        'payment_date',
        'status'
    ];

    protected $dates = [
        'date',
        'payment_date'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class,  'customer_id');
    }

    public function bills()
    {
        return $this->belongsTo(Bill::class, 'bill_id');
    }
}
