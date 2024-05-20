<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSpeciality extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'doctor_id',
        'speciality_id',
    ];
    public function tospeciality(){
        return $this->belongsToMany(Speciality::class, 'doctor_speciality_id');

    }
}
