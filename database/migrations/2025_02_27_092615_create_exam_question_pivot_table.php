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
        Schema::create('exam_question_pivot', function (Blueprint $table) {
            // Primary Key
            $table->uuid('id')->primary();
            
            // Foreign Keys
            $table->unsignedBigInteger('exam_id'); // Matches BIGINT type in exams.id
            $table->uuid('question_id'); // Matches UUID type in exam_questions.question_id
            
            // Ensure exam_id references exams table correctly
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
            
            // Ensure question_id correctly references exam_questions (check primary key in that table)
            $table->foreign('question_id')->references('question_id')->on('exam_questions')->onDelete('cascade');
            
            // Unique Constraint to prevent duplicate question-exam entries
            $table->unique(['exam_id', 'question_id']);
            
            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_question_pivot');
    }
};
