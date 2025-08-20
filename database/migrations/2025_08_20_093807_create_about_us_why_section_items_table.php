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
        Schema::create('about_us_why_section_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_us_why_section_id')->constrained()->onDelete('cascade');
            $table->string('image')->nullable();
            $table->text('title')->nullable();
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
        Schema::dropIfExists('about_us_why_section_items');
    }
};
