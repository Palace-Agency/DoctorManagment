<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'doctor_id',
        'label',
        'date_start',
        'time_start',
        'date_end',
        'time_end',
    ];
}
