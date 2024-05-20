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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->bigInteger('doctor_id'); //this id is for the doctor who has employees
            $table->enum("gender",["man","women"]);
            $table->date("date_naissance");
            $table->text("address");
            $table->bigInteger("city_id");
            $table->bigInteger("zip_code");
            $table->string('image');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_number');
            $table->enum('isActive',[0,1])->comment("0:not active / 1:active");
            $table->double("salary")->default(0);
            $table->bigInteger("role_id");
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('city_id') // Name of the foreign key column in the current table
                ->references('id') // Name of the referenced column in the referenced table
                ->on('cities') // Name of the referenced table
                ->onDelete('cascade'); // Action to perform on delete (optional)
            $table->foreign('role_id') // Name of the foreign key column in the current table
                ->references('id') // Name of the referenced column in the referenced table
                ->on('roles') // Name of the referenced table
                ->onDelete('cascade'); // Action to perform on delete (optional)

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
