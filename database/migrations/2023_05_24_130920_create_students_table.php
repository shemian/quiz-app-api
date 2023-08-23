<?php
use App\Enums\AccountStatus;
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
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('guardian_id')->constrained('guardians')->cascadeOnDelete();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('active_subscription')->nullable();
            $table->uuid('education_system_id')->constrained('education_systems', 'id')->cascadeOnDelete();
            $table->uuid('education_level_id')->constrained('education_levels', 'id')->cascadeOnDelete();
            $table->string('Date_of_birth');
            $table->string('school_name');
            $table->string('student_phone_number')->nullable();
            $table->decimal('credit', 8,2)->nullable()->default(0)  ;
            $table->decimal('centy_balance', 8,2)->nullable()->default(0);
            $table->decimal('debit', 8,2)->nullable()->default(0);
            $table->tinyInteger('account_status')->default(AccountStatus::INACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
