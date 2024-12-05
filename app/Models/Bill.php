<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'record_meter_id',
        'last_meter',
        'current_meter',
        'usage_amount',
        'total_bill',
        'status',
        'last_meter',
        'user_id',
        'current_meter'
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function recordMeter()
    {
        return $this->belongsTo(RecordMeter::class);
    }
}
