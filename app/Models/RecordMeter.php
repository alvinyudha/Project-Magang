<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordMeter extends Model
{
    use HasFactory;
    protected $table = 'record_meters';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_customer',
        'name',
        'date',
        'last_meter',
        'current_meter',
        'meter_photos',
        'user_id'
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
