<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motif extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "speciality_id",
        "nom_motif",
        "description"
    ];

    public function speciality(){
        return $this->belongsTo(Speciality::class,'speciality_id');
    }
}
