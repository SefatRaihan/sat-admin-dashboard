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
        Schema::create('contact_us_why_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('x')->nullable();
            $table->boolean('x_status')->default(0);
            $table->string('email')->nullable();
            $table->boolean('email_status')->default(0);
            $table->string('phone_no')->nullable();
            $table->boolean('phone_no_status')->default(0);
            $table->string('cta_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_us_why_sections');
    }
};
