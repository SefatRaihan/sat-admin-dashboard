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
        Schema::create('general_histories', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->unsignedBigInteger('general_id')->nullable()->index();
            $table->string('logo')->nullable();
            $table->string('favicon_icon')->nullable();
            $table->string('title')->nullable();
            $table->string('tag_line')->nullable();
            $table->string('privacy_policy_header')->nullable();
            $table->string('privacy_policy_sub_header')->nullable();
            $table->string('terms_condition_header')->nullable();
            $table->string('terms_condition_sub_header')->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->longText('terms_condition')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('custom_html_body')->nullable();
            $table->longText('custom_css_header')->nullable();
            $table->longText('custom_css_body')->nullable();
            $table->longText('custom_css_footer')->nullable();
            $table->longText('custom_script_header')->nullable();
            $table->longText('custom_script_body')->nullable();
            $table->longText('custom_script_footer')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();
			$table->string('action', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_histories');
    }
};
