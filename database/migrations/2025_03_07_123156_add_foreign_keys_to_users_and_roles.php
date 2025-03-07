<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add foreign key constraints to `users` table
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('active_role_id')->references('id')->on('roles')->onDelete('set null');
        });

        // Add foreign key constraints to `roles` table
        Schema::table('roles', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove foreign key constraints from `users` table
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['active_role_id']);
        });

        // Remove foreign key constraints from `roles` table
        Schema::table('roles', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
    }
};
