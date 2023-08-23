<?php

use App\Enums\InvoiceStatus;
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
            $table->uuid('id')->primary();
            $table->foreignUuid('guardian_id')->constrained('guardians')->onDelete('cascade');
            $table->decimal('amount', 8, 2);
            $table->decimal('tax', 8, 2)->nullable();
            $table->decimal('discount', 8, 2)->nullable();
            $table->decimal('total_amount', 8, 2);
            $table->date('due_date');
            $table->tinyInteger('status')->default(InvoiceStatus::UNPAID);
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
