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
        Schema::create('drill_exam_attempts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('exam_name')->unique();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->integer('remaining_time')->nullable()->comment('Remaining time in seconds');
            $table->enum('status', ['in_progress', 'paused', 'completed', 'expired', 'terminated', 'review_pending'])->default('in_progress')->comment('Exam attempt status')->index();
            $table->decimal('score', 5, 2)->nullable();
            $table->integer('attempt_number')->default(1)->comment('Tracks user attempt count')->index();
            $table->integer('correct_answers')->default(0)->comment('Number of correct answers');
            $table->integer('wrong_answers')->default(0)->comment('Number of incorrect answers');
            $table->json('answers')->nullable()->comment('Stores submitted answers in JSON format');
            $table->json('metadata')->nullable()->comment('Stores additional attempt data');
            $table->ipAddress('ip_address')->nullable()->comment('Tracks IP address of the attempt')->index();
            $table->string('device_info', 255)->nullable()->comment('Stores user device details');
            $table->boolean('cheating_detected')->default(false)->comment('Flag for cheating detection');

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
        Schema::dropIfExists('exam_attempts');
    }
};
