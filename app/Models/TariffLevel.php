<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TariffLevel extends Model
{
    use HasFactory;
    protected $fillable = ['group_id', 'level', 'tariff', 'user_id'];

    public function tariffGroup()
    {
        return $this->belongsTo(TariffGroup::class, 'group_id');
    }
}
