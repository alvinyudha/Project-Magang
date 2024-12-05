<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disolir extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_code',
        'group_id',
        'identity_card_number',
        'name',
        'address',
        'no_telp',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
