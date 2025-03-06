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
        Schema::create('exam_questions', function (Blueprint $table) {
            // Change question_id from UUID to BIGINT (Auto-incrementing ID)
            $table->id(); // This replaces the previous UUID-based primary key
            
            // Question Details
            $table->text('question_text');
            $table->enum('question_type', ['MCQ', 'Fill-in-the-Blank', 'Paragraph'])->default('MCQ');
            $table->json('options')->nullable()->comment('Stores possible answers for MCQs');
            $table->string('correct_answer', 255);
            $table->enum('difficulty', ['Easy', 'Medium', 'Hard', 'Very Hard'])->default('Medium');
            $table->json('tags')->nullable()->comment('Tags for categorization');
            $table->text('explanation')->nullable();
            $table->integer('version_number')->default(1)->comment('Tracks updates to questions');
            $table->string('language_code', 10)->default('en')->comment('Supports multiple languages');

            // Media Support
            $table->json('images')->nullable()->comment('Stores multiple image URLs');
            $table->json('videos')->nullable()->comment('Stores multiple video URLs');

            // Tracking Users (On user delete, question is not deleted)
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');

            // Soft Deletes & Timestamps
            $table->softDeletes();
            $table->timestamps();

            // Indexing for Performance
            $table->index(['difficulty'], 'idx_difficulty');
            $table->index(['deleted_at'], 'idx_deleted_at');
            $table->index(['language_code'], 'idx_language_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_questions');
    }
};
