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
        Schema::create('section_question_pivot', function (Blueprint $table) {
            // Primary Key
            $table->uuid('id')->primary();
            
            // Foreign Keys
            $table->unsignedBigInteger('section_id');
            $table->uuid('question_id');
            
            // Constraints
            $table->foreign('section_id')->references('id')->on('exam_sections')->onDelete('cascade');
            $table->foreign('question_id')->references('question_id')->on('exam_questions')->onDelete('cascade');
            
            // Unique Constraint to prevent duplicate questions in the same section
            $table->unique(['section_id', 'question_id']);
            
            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_question_pivot');
    }
};
