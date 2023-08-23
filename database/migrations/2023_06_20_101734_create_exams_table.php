<?php

use App\Enums\ExamType;
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
        Schema::create('exams', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->string('name');
            $table->foreignUuid('subject_id')->nullable()->references('id')->on('subjects')->cascadeOnDelete();
            $table->tinyInteger('exam_type')->default(ExamType::NORMAL);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
