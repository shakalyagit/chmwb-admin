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
        Schema::create('module_manages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('parent_menu')->nullable();
            $table->string('route_name');
            $table->text('icon_class');
            $table->integer('is_visible')->default(1);
            $table->integer('order_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('module_manages');
    }
};
