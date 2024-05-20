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
        Schema::create('working_hours', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('doctor_id');
            $table->enum('day_of_week',["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sanday"]);
            $table->time('start_time');
            $table->time('end_time');
            // $table->string('task');
            $table->enum('day_off',["active", "disable"]);
            $table->enum("type_consultation",['remote', 'personnel', "both"]);
            $table->timestamps();
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working_hours');
    }
};
