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
        Schema::create('pharmacy_meds', function (Blueprint $table) {
            $table->id();
            $table->mediumText('medicament');
            $table->text('treatment');
            $table->bigInteger('id_ordonnance');
            $table->timestamps();
            $table->foreign('id_ordonnance')->references('id')->on('ordonnance')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacy_meds');
    }
};
