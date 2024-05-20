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
        Schema::create('parametres', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('doctor_id')->unique();
            $table->double('tarif_consult');
            $table->longText("bio");
            $table->text("speciality_id");
            $table->string('logo',255);
            $table->string('entete',255);
            $table->longText('experience');
            $table->string('images',255);
            $table->text('language_spoken');
            $table->enum('mode_abonnement',['free','basic','premium']);
            $table->enum('duree_appointments',[15,30,60]);
            $table->double('solde_total');
            $table->timestamps();
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parametres');
    }
};
