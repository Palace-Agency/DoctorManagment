<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy_med extends Model
{
    use HasFactory;
    protected $fillable = [
        'medicament',
        'treatment',
        'id_ordonnance',
    ];
    public function ordonnace()
    {
        return $this->belongsTo(Ordonnance::class, 'id_ordonnance');
    }
}
