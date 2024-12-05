<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TariffGroup extends Model
{
    use HasFactory;

    protected $fillable = ['group_name', 'desc', 'user_id', 'group'];

    public function levelTariffs()
    {
        return $this->hasMany(TariffLevel::class, 'group_id');
    }
    public function customer()
    {
        return $this->hasMany(Customer::class);
    }
}