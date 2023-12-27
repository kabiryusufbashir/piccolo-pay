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
        Schema::create('customer_bank_details', function (Blueprint $table) {
            $table->id();
            $table->string('cust_id');
            $table->string('bank_name');
            $table->string('acct_name');
            $table->string('acct_no');
            $table->timestamps();

            $table->index('cust_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_bank_details');
    }
};
