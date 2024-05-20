<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'doctor_id',
        'tarif_consult',
        'bio',
        'speciality_id',
        'logo',
        'entete',
        'experience',
        'images',
        'language_spoken',
        'mode_abonnement',
        'duree_appointments',
        'solde_total',
        'motifs',

    ];
    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'speciality_id');
    }
    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id');

    }

}
