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
        Schema::create('user_histories', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('active_role_id')->nullable()->index();
            $table->string('first_name')->index();
            $table->string('last_name')->index();
            $table->string('full_name')->index();
            $table->string('email')->index();
            $table->string('phone')->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(true)->index();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('last_login')->nullable()->index();
            $table->string('image')->nullable();
            $table->softDeletes();
            $table->rememberToken();
			$table->string('action', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_histories');
    }
};
