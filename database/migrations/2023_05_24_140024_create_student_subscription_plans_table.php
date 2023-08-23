<?php
use App\Enums\StudentSubscriptionPlanStatus;
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
        Schema::create('student_subscription_plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('student_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('subscription_plan_id')->constrained()->cascadeOnDelete();
            $table->timestamp('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->tinyInteger('status')->default(StudentSubscriptionPlanStatus::ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_subscription_plans');
    }
};
