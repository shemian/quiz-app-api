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
        Schema::create('mpesa_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('transaction_type')->nullable();
            $table->string('trans_id')->unique();
            $table->string('trans_time')->nullable();
            $table->string('business_short_code')->nullable();
            $table->string('bill_ref_number')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('third_party_trans_id')->nullable();
            $table->string('msisdn')->nullable();
            $table->decimal('trans_amount', 8, 2)->nullable();
            $table->decimal('org_account_balance', 8, 2)->nullable();
            $table->tinyInteger('consumed')->unsigned()->default(false);
            $table->timestamps(6);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mpesa_transactions');
    }
};
