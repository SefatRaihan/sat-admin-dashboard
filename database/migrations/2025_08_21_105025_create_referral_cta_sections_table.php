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
        Schema::create('referral_cta_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('cta_text')->nullable();
            $table->string('cta_link')->nullable();
            $table->string('image')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('info_title')->nullable();
            $table->string('info_subtitle')->nullable();
            $table->string('info_line_1')->nullable();
            $table->string('info_line_2')->nullable();
            $table->string('info_line_3')->nullable();
            $table->string('section_subtitle')->nullable();
            $table->string('section_cta_text')->nullable();
            $table->string('section_cta_link')->nullable();
            $table->string('clutch_review_cta_text')->nullable();
            $table->string('clutch_review_cta_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_cta_sections');
    }
};
