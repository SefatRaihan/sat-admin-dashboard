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
            // Primary Key
            $table->id(); // BIGINT Auto-incrementing ID
            $table->uuid('uuid')->index(); // BIGINT Auto-incrementing ID
            
            // Audience Selection
            $table->enum('audience', ['High School', 'College', 'Graduation', 'SAT 2'])->default('High School')->comment('Defines the target audience for the question');

            // SAT Type
            $table->enum('sat_type', ['SAT 1', 'SAT 2'])->nullable()->comment('Defines if the question is for SAT 1 or SAT 2');

            // SAT Question Type
            $table->enum('sat_question_type', ['Physics', 'Chemistry', 'Biology', 'Math', 'Verbal', 'Quant'])->nullable()->comment('Specifies the subject type for SAT questions');

            // Question Details
            $table->text('question_title')->comment('Short title for the question');
            $table->text('question_description')->nullable()->comment('Detailed description of the question');
            $table->text('question_text');
            $table->enum('question_type', ['MCQ', 'Fill-in-the-Blank', 'Paragraph'])->default('MCQ');
            $table->json('options')->nullable()->comment('Stores possible answers for MCQs');
            $table->string('correct_answer', 255);
            $table->enum('difficulty', ['Easy', 'Medium', 'Hard', 'Very Hard'])->default('Medium');
            $table->json('tags')->nullable()->comment('Tags for categorization');
            $table->longText('explanation')->nullable();
            $table->integer('version_number')->default(1)->comment('Tracks updates to questions');
            $table->string('language_code', 10)->default('en')->comment('Supports multiple languages');

            // Question Status
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('Determines if the question is available for use');

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
            $table->index(['status'], 'idx_status');
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