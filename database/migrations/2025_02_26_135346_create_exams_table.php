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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->string('name', 120)->index();
            $table->enum('audience', ['high_school', 'college', 'graduation', 'sat_2'])->index();
            $table->integer('total_questions');
            $table->integer('total_duration'); // In minutes
            $table->boolean('has_time_gaps')->default(false); // Optional breaks between sections
            $table->integer('retake_cooldown')->nullable(); // Optional cooldown period in hours
            $table->enum('result_processing', ['instant', 'admin_approval'])->default('instant');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft')->index();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
