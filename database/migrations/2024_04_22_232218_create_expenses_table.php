<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("doctor_id");
            $table->string('name');
            $table->text("description");
            $table->bigInteger("category_expense_id");
            $table->enum("status",["paid","unpaid"]);
            $table->double('amount');
            $table->timestamps();
            $table->foreign('doctor_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('category_expense_id')
                ->references('id')
                ->on('category_expenses')
                ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
