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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->string('name')->unique()->index();
            $table->string('slug')->unique()->index();
            $table->text('description')->nullable();
            $table->boolean('is_supervisor_role')->default(false);
            
            // Foreign key references
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            
            $table->softDeletes();
            $table->timestamps();

            // Foreign key constraints
           // $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
           // $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
           // $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
