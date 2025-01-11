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
            $table->datetime('date_start');
            $table->datetime('date_end');
            $table->integer('total_orders')->default(0);
            $table->integer('total_products')->default(0);
            $table->integer('total_suppliers')->default(0);
            $table->unsignedBigInteger('top_product_id')->nullable();
            $table->integer('top_product_total')->default(0);
            $table->unsignedBigInteger('top_supplier_id')->nullable();
            $table->integer('top_supplier_total')->default(0);
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
