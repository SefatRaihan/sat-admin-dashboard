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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique()->index();
            $table->string('code')->unique()->index();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('audience')->nullable();
            $table->string('subject')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('total_chapter')->nullable();
            $table->integer('total_lesson')->nullable();
            $table->integer('total_duration')->nullable();
            $table->foreignId('exam_id')->nullable()->constrained('exams')->onDelete('Set null')->comment('References the exam associated with the course');
            $table->tinyInteger('is_exam_create')->default(0)->comment('Indicates if the course has an associated exam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
