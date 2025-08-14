<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStudentHistoriesForMultipleAudiences extends Migration
{
    public function up()
    {
        Schema::table('student_histories', function (Blueprint $table) {
            // Change old_value and new_value to text to support JSON or comma-separated values
            $table->dropColumn('audience');
        });
    }

    public function down()
    {
        Schema::table('student_histories', function (Blueprint $table) {
            // Revert to string if needed
        });
    }
}