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
        Schema::create('waiter_orders', function (Blueprint $table) {
            $table->string('id')->unique()->default('O' . Str::random(5)); 
            $table->foreignId('waiter_id')->constrained();
            $table->foreignId('table_id')->constrained();
            $table->text('items'); 
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['confirmed', 'completed'])->default('confirmed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waiter_orders');
    }
};
