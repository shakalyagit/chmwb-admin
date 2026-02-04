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
        Schema::create('patient_msts', function (Blueprint $table) {
            $table->id();
            $table->integer('shop_id');
            $table->string('patient_name');
            $table->string('patient_number');
            $table->string('city')->nullable();
            $table->string('state')->default('West Bengal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_msts');
    }
};
