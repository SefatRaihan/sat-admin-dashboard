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
        Schema::create('mixed_section_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mixed_section_id')->constrained()->onDelete('cascade'); // Foreign key to mixed_sections
            $table->string('image')->nullable(); // Image for items
            $table->string('title')->nullable(); // Title for item
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mixed_section_items');
    }
};
