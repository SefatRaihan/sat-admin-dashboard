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
        Schema::create('student_histories', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->unsignedBigInteger('student_id')->nullable()->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('student_code')->index();
            $table->string('name')->index();
            $table->string('email')->index();
            $table->string('phone')->index();
            $table->enum('gender', ['male', 'female', 'other'])->index();
            $table->date('date_of_birth');
            $table->string('audience')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default('active');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
			$table->string('action', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_histories');
    }
};
