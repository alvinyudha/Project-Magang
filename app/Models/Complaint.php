<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $table = 'complaint';
    protected $primaryKey = 'id_complaint';
    protected $fillable = [
        'tittle',
        'describe',
        'photo',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function officers()
    {
        return $this->belongsTo(User::class, 'officer');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
