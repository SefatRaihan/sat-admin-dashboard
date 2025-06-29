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
            $table->uuid('uuid')->unique()->index(); // BIGINT Auto-incrementing ID
            $table->foreignId('topic_id')->constrained('topics')->onDelete('Set null')->comment('References the topic this question belongs to')->index();

            // Audience Selection
            $table->enum('audience', ['High School', 'College', 'Graduation', 'SAT 2'])->comment('Defines the target audience for the question')->index();

            // SAT Type
            $table->enum('sat_type', ['SAT 1', 'SAT 2'])->nullable()->comment('Defines if the question is for SAT 1 or SAT 2')->index();

            // SAT Question Type
            $table->enum('sat_question_type', ['Physics', 'Chemistry', 'Biology', 'Math', 'Verbal', 'Quant'])->nullable()->comment('Specifies the subject type for SAT questions')->index();

            // Question Details
            $table->text('question_title')->comment('Short title for the question');
            $table->text('question_description')->nullable()->comment('Detailed description of the question');
            $table->text('question_text');
            $table->enum('question_type', ['MCQ', 'Fill-in-the-Blank', 'Paragraph'])->default('MCQ')->index();
            $table->json('options')->nullable()->comment('Stores possible answers for MCQs');
            $table->string('correct_answer', 255);
            $table->enum('difficulty', ['Easy', 'Medium', 'Hard', 'Very Hard'])->default('Medium')->index();
            $table->json('tags')->nullable()->comment('Tags for categorization');
            $table->longText('explanation')->nullable();
            $table->integer('version_number')->default(1)->comment('Tracks updates to questions');
            $table->string('language_code', 10)->default('en')->comment('Supports multiple languages');
            $table->string('question_code')->index();

            // Question Status
            $table->enum('status', ['active', 'inactive'])->default('active')->comment('Determines if the question is available for use')->index();

            // Media Support
            $table->json('images')->nullable()->comment('Stores multiple image URLs');
            $table->json('videos')->nullable()->comment('Stores multiple video URLs');

            // Foreign key references
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->softDeletes();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
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