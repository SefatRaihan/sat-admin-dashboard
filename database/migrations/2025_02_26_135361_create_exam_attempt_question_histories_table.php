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
        Schema::create('exam_attempt_question_histories', function (Blueprint $table) {
            // Primary Key
            $table->uuid('id')->primary();

            // Foreign Keys: Links to an exam attempt and a question
            $table->foreignUuid('uuid')->index();
            $table->foreignUuid('attempt_id')->index();
            $table->foreignId('question_id')->index();

            // Answer Details
            $table->string('student_answer', 255)->nullable()->comment('User-submitted answer')->index();
            $table->boolean('is_correct')->default(false)->comment('Indicates if the answer was correct')->index();
            $table->integer('time_spent')->unsigned()->nullable()->comment('Time spent on the question in seconds')->index();

            // Media Support
            $table->json('image_urls')->nullable()->comment('Stores multiple image URLs');
            $table->json('video_urls')->nullable()->comment('Stores multiple video URLs');

            // Soft Deletes & Timestamps
            $table->softDeletes();
            $table->string('action', 100)->comment('Action performed on the exam attempt question history');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_attempt_question_histories');
    }
};