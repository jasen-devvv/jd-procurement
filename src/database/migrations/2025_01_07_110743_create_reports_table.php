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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('range_start');
            $table->date('range_end');
            $table->integer('total_orders')->default(0);
            $table->integer('total_new_products')->default(0);
            $table->integer('total_new_suppliers')->default(0);
            $table->unsignedBigInteger('top_product_id')->nullable();
            $table->unsignedBigInteger('top_supplier_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
