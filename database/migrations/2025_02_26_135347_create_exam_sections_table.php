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
        Schema::create('exam_sections', function (Blueprint $table) {
            // Primary Key
            $table->id();
            
            // Unique Identifier
            $table->uuid('uuid')->unique()->index();
            
            // Foreign Key: Associated Exam
            $table->unsignedBigInteger('exam_id')->index()->comment('References the exam this section belongs to');
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
            
            // Section Details
            $table->string('title')->index()->comment('Title of the section');
            $table->text('description')->nullable()->comment('Detailed description of the section');
            $table->integer('duration')->unsigned()->nullable()->comment('Duration in minutes for this section');
            $table->integer('section_order')->default(1)->comment('Defines the order of sections within an exam');
            
            // Tracking Users (On user delete, values are set to null)
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
            
            // Soft Deletes & Timestamps
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_sections');
    }
};
