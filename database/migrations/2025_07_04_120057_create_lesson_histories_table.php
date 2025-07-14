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
        Schema::create('lesson_histories', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->uuid('lesson_id')->index();
            $table->enum('audience', ['High School', 'Graduation', 'College', 'SAT 2']);
            $table->enum('question_type', ['Verbal', 'Quant', 'Physics', 'Chemistry', 'Biology', 'Math'])->nullable();
            $table->string('file_name');
            $table->string('total_length')->nullable();
            $table->enum('file_type', ['Video', 'PDF', 'Image', 'Audio']);
            $table->float('file_size'); // in MB
            $table->string('file_path');
            $table->boolean('state')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->string('action', 100); // Action type: created, updated, deleted
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_histories');
    }
};
