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
        Schema::create('motifs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("speciality_id");
            $table->string('nom_motif');
            $table->longText("description");
            $table->timestamps();
            $table->foreign('speciality_id')
                ->references('id')
                ->on('specializations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motifs');
    }
};
