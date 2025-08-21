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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('package_code')->index();        // your internal order ref
            $table->string('tap_charge_id')->nullable()->index();
            $table->unsignedInteger('amount');          // stored in minor units? Tap sends decimal; you decide
            $table->string('currency', 3)->default('KWD');
            $table->string('status')->default('pending'); // initiated, captured, failed, canceled
            $table->json('tap_payload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
