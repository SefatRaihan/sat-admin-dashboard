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
        Schema::create('exam_attempt_questions', function (Blueprint $table) {
            // Primary Key
            $table->uuid('id')->primary();

            // Foreign Keys: Links to an exam attempt and a question
            $table->uuid('attempt_id');
            // $table->foreign('attempt_id')->references('id')->on('exam_attempts')->onDelete('cascade');
            // $table->foreignId('question_id')->constrained('exam_questions')->onDelete('cascade');

            // Answer Details
            $table->string('student_answer', 255)->nullable()->comment('User-submitted answer');
            $table->boolean('is_correct')->default(false)->comment('Indicates if the answer was correct');
            $table->integer('time_spent')->unsigned()->nullable()->comment('Time spent on the question in seconds');

            // Media Support
            $table->json('image_urls')->nullable()->comment('Stores multiple image URLs');
            $table->json('video_urls')->nullable()->comment('Stores multiple video URLs');

            // Soft Deletes & Timestamps
            $table->softDeletes();
            $table->timestamps();

            // Indexing for Optimization
            $table->index(['attempt_id'], 'idx_attempt_id');
            // $table->index(['question_id'], 'idx_question_id');
            $table->index(['is_correct'], 'idx_is_correct');
            $table->index(['deleted_at'], 'idx_deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_attempt_questions');
    }
};