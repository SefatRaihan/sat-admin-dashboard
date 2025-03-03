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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('name')->index();
            $table->string('student_code')->index();
            $table->string('email')->unique()->index();
            $table->string('phone')->index();
            $table->enum('gender', ['male', 'female', 'other'])->index();
            $table->date('date_of_birth');
            $table->string('audience')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default('active');
            $table->string('package')->default('super-man');
            $table->string('duration')->default('monthly');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
