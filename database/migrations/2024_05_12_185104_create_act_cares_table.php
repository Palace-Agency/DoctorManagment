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
        Schema::create('act_cares', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('doctor_id');
            $table->string('name_act');
            $table->string('name_mutuelle');
            $table->bigInteger('cat_id');
            $table->integer('honoraires');
            $table->enum('remboursement_acte',[0,1])->comment('0 : non remboursable / 1 : remboursable');
            $table->string('code');
            $table->integer('coefficient');
            $table->timestamps();
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cat_id')->references('id')->on('category_act_cares')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('act_cares');
    }
};
