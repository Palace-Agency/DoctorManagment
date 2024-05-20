<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    use HasFactory;
        protected $fillable = [
            'patient_id',
            'doctor_id',
            'type_ordonnance',
            'remarque',
        ];
    public function pharmacyMeds()
    {
        return $this->hasMany(Pharmacy_med::class, 'id_ordonnance');
    }
    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
