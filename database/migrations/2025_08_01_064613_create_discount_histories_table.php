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
        Schema::create('discount_histories', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->string('code')->unique();
            $table->decimal('amount', 10, 2);
            $table->enum('type', ['percentage', 'fixed'])->default('percentage');
            $table->integer('max_num_of_uses')->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_histories');
    }
};
