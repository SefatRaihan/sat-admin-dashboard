<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('student_notifications', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->foreignId('student_id')->constrained()->onDelete('cascade'); 
            $table->string('title');
            $table->text('description');
            $table->date('date');
            $table->time('time');
            $table->boolean('is_sent')->default(false);
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
        Schema::dropIfExists('student_notifications');
    }
};
