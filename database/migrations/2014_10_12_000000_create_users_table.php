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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->string('active_role_id')->nullable()->index();
            $table->string('first_name')->index()->nullable();
            $table->string('last_name')->index()->nullable();
            $table->string('full_name')->index();
            $table->string('email')->unique()->index();
            $table->string('phone')->unique()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(true)->index();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('last_login')->nullable()->index();
            $table->string('profile_image')->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
