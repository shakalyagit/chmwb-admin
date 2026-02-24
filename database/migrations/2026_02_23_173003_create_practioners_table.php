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
        Schema::create('practioners', function (Blueprint $table) {
            $table->id();
            $table->string('registration_no');
            $table->date('registration_date');
            $table->string('name');
            $table->string('fathers_name');
            $table->text('address');
            $table->string('district');
            $table->string('state');
            $table->string('pincode');
            $table->string('ph_no');
            $table->string('email_id');
            $table->string('qualification');
            $table->string('part');
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practioners');
    }
};
