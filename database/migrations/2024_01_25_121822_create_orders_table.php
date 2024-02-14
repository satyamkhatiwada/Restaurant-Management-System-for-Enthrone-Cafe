<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('id')->unique()->default(Str::uuid());
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('phone_number')->length(10);
            $table->text('items'); 
            $table->string('delivery_address');
            $table->string('landmark');
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
