<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'company';
    protected $primaryKey = 'id_company';
    protected $fillable = [
        'company_code',
        'name',
        'address',
        'email',
        'fax',
        'pict',
        'no_telp',
        'retribution',
        'fines'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'company_id');
    }
}
