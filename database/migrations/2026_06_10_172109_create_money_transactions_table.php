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
        Schema::create('money_transactions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('transaction_date');
            $table->decimal('amount', 15, 2);
            $table->integer('transaction_type');
            $table->boolean('atm');
            $table->longText('notes')->nullable();
            $table->foreignId('booking_id')->nullable()->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('money_transactions');
    }
};
