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
        Schema::create('customer_transaction_histories', function (Blueprint $table) {
            $table->id();
            $table->string('cust_id');
            $table->string('transaction_type');
            $table->string('transaction_amount');
            $table->string('transaction_paid');
            $table->string('reference');
            $table->string('status');
            $table->timestamps();

            $table->index('cust_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_transaction_histories');
    }
};
