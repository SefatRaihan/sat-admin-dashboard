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
        Schema::create('referral_step_section_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referral_step_section_id')->constrained()->onDelete('cascade');
            $table->string('icon')->nullable(); // NEW COLUMN
            $table->string('image')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_step_section_items');
    }
};
