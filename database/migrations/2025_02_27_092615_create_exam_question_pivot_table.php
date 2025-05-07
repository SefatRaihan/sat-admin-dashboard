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
            $table->unsignedBigInteger('question_id')->index(); // Changed from UUID to BIGINT
            $table->unsignedBigInteger('exam_id')->index();

            // Composite primary key for ensuring uniqueness
            $table->primary(['exam_id', 'question_id']);

            // Foreign key constraints
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('exam_questions')->onDelete('cascade');

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