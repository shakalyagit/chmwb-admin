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
        Schema::create('pharmacy_registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pharmacist_id');
            $table->string('registration_number', 100)->unique();
            $table->date('date_of_registration')->nullable();
            $table->date('valid_upto')->nullable();
            $table->string('qualification_name', 100)->nullable();
            $table->string('qualification_held', 100)->nullable();
            $table->string('qualification_college', 100)->nullable();
            $table->string('add_qualification_name', 100)->nullable();
            $table->string('add_qualification_held', 100)->nullable();
            $table->string('add_qualification_college', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacy_registrations');
    }
};
