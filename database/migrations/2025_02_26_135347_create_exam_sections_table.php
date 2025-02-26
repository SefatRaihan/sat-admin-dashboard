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
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');
            $table->string('section_name', 120)->index();
            $table->enum('section_type', ['verbal', 'quant', 'physics', 'chemistry', 'maths', 'biology', 'mixed'])->index();
            $table->integer('num_questions');
            $table->integer('duration'); // In minutes
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
