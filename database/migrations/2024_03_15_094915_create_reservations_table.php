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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');
            $table->string('address');
            $table->integer('pax');
            $table->json('rentals')->nullable();
            $table->json('add_ons')->nullable();
            $table->string('occasion');
            $table->date('date');
            $table->time('time');
            $table->decimal('total_cost', 8, 2);
            $table->decimal('amount_paid', 8, 2)->nullable();
            $table->integer('payment_percent');
            $table->string('receipt_img');
            $table->json('payment_dates')->nullable();
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
