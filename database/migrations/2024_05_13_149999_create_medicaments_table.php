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
        Schema::create('medicaments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('code');
            $table->string('nom');
            $table->string('dci1');
            $table->string('dosage1');
            $table->string('unite_dosage1');
            $table->string('forme');
            $table->string('presentation');
            $table->double('ppv');
            $table->double('ph');
            $table->double('prix_br');
            $table->char('princeps_generique');
            $table->string('taux_remboursement');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicaments');
    }
};
