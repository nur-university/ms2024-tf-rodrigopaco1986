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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('service_id')->index();
            $table->string('service_code', 30);
            $table->string('service_name');
            $table->string('service_unit', 100);
            $table->unsignedSmallInteger('quantity');
            $table->decimal('price', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->decimal('subtotal', 8, 2);
            $table->uuid('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
