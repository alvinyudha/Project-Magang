<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'id_customer';
    protected $fillable = [
        'customer_code',
        'group_id',
        'identity_card_number',
        'name',
        'address',
        'no_telp',
        'location',
        'land_status',
        'land_area',
        'building_area',
        'meter_number',
        'identity_card',
        'family_card',
        'property_tax',
        'land_document',
        'electricity_account',
        'status'
    ];

    public function tariffGroup()
    {
        return $this->belongsTo(TariffCategory::class, 'group_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}