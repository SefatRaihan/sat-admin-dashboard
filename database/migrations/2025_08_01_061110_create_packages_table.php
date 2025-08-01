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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->string('package_type');
            $table->string('audience')->nullable();
            $table->integer('duration_days')->default(0);
            $table->tinyInteger('status')->default(1); // 1: active, 0: inactive
            $table->boolean('highlight_Status')->default(true);
            $table->string('title');
            $table->text('description')->nullable();
            $table->float('promotional_badge', 5, 2)->default(0.00);
            $table->boolean('highlight_badge')->default(true);
            $table->decimal('price', 10, 2);
            $table->enum('pricing_terms', ['monthly', 'yearly', '3month', '6month', 'others'])->default('monthly');
            $table->text('terms_per_month')->nullable();
            $table->text('other_description')->nullable();
            $table->string('validity')->nullable();
            $table->timestamp('activated_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
