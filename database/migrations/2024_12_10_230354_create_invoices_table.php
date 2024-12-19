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
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('nit', 50);
            $table->unsignedMediumInteger('number');
            $table->string('authorization_code', 100);
            $table->dateTime('invoice_date');
            $table->uuid('customer_id')->index();
            $table->unsignedMediumInteger('customer_code');
            $table->string('customer_name', 100);
            $table->string('customer_nit', 50);
            $table->enum('status', ['CREATED', 'CANCELLED']);
            $table->decimal('total', 10, 2);
            $table->uuid('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
