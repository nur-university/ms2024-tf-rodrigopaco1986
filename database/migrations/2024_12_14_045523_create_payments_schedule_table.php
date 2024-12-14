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
        Schema::create('payments_schedule', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->unsignedSmallInteger('number');
            $table->decimal('amount', 8, 2);
            $table->dateTime('due_date');
            $table->enum('status', ['PENDING', 'PAID']);
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
        Schema::dropIfExists('payments_schedule');
    }
};
