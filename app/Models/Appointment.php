<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        "appointment_id" ,
        "doctor_id",
        "patient_id",
        "appontment_date" ,
        "start_at" ,
        "end_at" ,
        "medical_information" ,
        "status" ,
        "motif_id" ,
        "type_appointment" ,
        "controle"  ,

    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
    public function motif(){
        return $this->belongsTo(Motif::class, 'motif_id');

    }
    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id');
    }

}
