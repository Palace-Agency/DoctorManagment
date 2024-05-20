<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "doctor_id",
        "name",
        "description",
        "category_expense_id",
        "status",
        "amount"
    ];

    public function user(){
        return $this->belongsTo(User::class,'id');
    }
    public function categoryExpense(){
        return $this->belongsTo(CategoryExpense::class, 'id');
    }
}
