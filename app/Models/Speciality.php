<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",
        "name_sp",
        "description"
    ];
    public function users()
    {
        return $this->belongsToMany(Parametre::class, 'doctor_specialities');
    }

}
