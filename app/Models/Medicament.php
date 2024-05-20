<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'nom',
        'dci1',
        'dosage1',
        'unite_dosage1',
        'forme',
        'presentation',
        'ppv',
        'ph',
        'prix_br',
        'princeps_generique',
        'taux_remboursement',
    ];
}
