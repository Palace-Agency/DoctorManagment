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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('doctor_id');
            $table->bigInteger('patient_id');
            $table->date('appontment_date');
            $table->time('start_at');
            $table->time('end_at');
            $table->mediumText('medical_information');
            $table->enum('status',['waiting', 'inprogress', 'pending', 'cancelled', 'completed']);
            $table->bigInteger('motif_id');
            $table->enum('type_appointment',['remote', 'personnel']);
            $table->enum('controle',[0, 1]);
            $table->timestamps();
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
