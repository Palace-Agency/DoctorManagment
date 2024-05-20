<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActCare extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'name_act',
        'name_mutuelle',
        'cat_id',
        'honoraires',
        'remboursement_acte',
        'code',
        'coefficient',
    ];

    public function category(){
        return $this->belongsTo(CategoryActCare::class,'cat_id');
    }
}
