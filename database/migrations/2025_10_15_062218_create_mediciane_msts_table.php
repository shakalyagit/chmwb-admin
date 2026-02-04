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
        Schema::create('mediciane_msts', function (Blueprint $table) {
            $table->id();
            $table->integer('shop_id');
            $table->string('medicin_id');
            $table->string('name', 150);
            $table->string('generic_name', 150)->nullable();
            $table->string('hsn_code', 50)->nullable();
            $table->string('batch_no')->nullable();
            $table->date('expire_date')->nullable();
            $table->integer('total_file')->default(0);
            $table->integer('qty_per_file')->default(0);
            $table->decimal('per_file_mrp', 10, 2)->default(0.00);
            $table->integer('total_stock')->default(0);
            $table->decimal('per_stock_mrp', 10, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mediciane_msts');
    }
};
