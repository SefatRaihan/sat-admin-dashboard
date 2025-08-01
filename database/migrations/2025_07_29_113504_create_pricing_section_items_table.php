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
        Schema::create('pricing_section_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pricing_section_id')->constrained()->onDelete('cascade');
            $table->string('plan_title');
            $table->string('promotional_badge')->nullable();
            $table->boolean('promotional_badge_status')->default(false);
            $table->text('description')->nullable();
            $table->decimal('pricing', 10, 2)->nullable();
            $table->string('currency')->nullable();
            $table->string('pricing_terms')->nullable();
            $table->string('feature_1')->nullable();
            $table->string('feature_2')->nullable();
            $table->string('feature_3')->nullable();
            $table->string('feature_4')->nullable();
            $table->string('cta_text')->nullable();
            $table->string('cta_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_section_items');
    }
};
