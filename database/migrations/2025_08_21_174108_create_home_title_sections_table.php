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
        Schema::create('home_title_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('cta_text')->nullable();
            $table->string('cta_link')->nullable();
            $table->string('avater_1')->nullable();
            $table->string('avater_2')->nullable();
            $table->string('avater_3')->nullable();
            $table->string('avater_subtitle')->nullable();
            $table->string('whatsapp_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('tiktok_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('x_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->boolean('whatsapp_status')->default(false);
            $table->boolean('instagram_status')->default(false);
            $table->boolean('tiktok_status')->default(false);
            $table->boolean('youtube_status')->default(false);
            $table->boolean('x_status')->default(false);
            $table->boolean('facebook_status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_title_sections');
    }
};
