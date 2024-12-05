<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';
    protected $primaryKey = 'id_employee';
    protected $fillable = [
        'name', 'username', 'nip', 'email', 'password', 'no_telp', 'alamat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
