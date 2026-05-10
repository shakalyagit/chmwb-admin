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
        Schema::create('pharmacists', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('father_name', 150)->nullable();
            $table->char('aadhaar_number', 12)->unique();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('mobile_number', 15)->nullable();
            $table->string('email_id', 150)->nullable();
            $table->unsignedBigInteger('present_address_id')->nullable();
            $table->unsignedBigInteger('permanent_address_id')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacists');
    }
};
