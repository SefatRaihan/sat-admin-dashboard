<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStudentsAndCreateAudienceStudentTable extends Migration
{
    public function up()
    {
        // Drop the audience column from students table
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('audience');
        });

        // Create the pivot table for students and audiences
        Schema::create('audience_student', function (Blueprint $table) {
            $table->id();
            $table->uuid('student_uuid')->index();
            $table->string('audience')->index();
            $table->timestamps();

            $table->foreign('student_uuid')->references('uuid')->on('students')->onDelete('cascade');
        });

        // Create the audiences table
        Schema::create('audiences', function (Blueprint $table) {
            $table->string('audience')->primary();
            $table->timestamps();
        });

        // Seed the audiences table
        $audiences = ['High School', 'College', 'Graduate', 'SAT 2'];
        foreach ($audiences as $audience) {
            \App\Models\Audience::create(['audience' => $audience]);
        }
    }

    public function down()
    {
        // Recreate the audience column in students table
        Schema::table('students', function (Blueprint $table) {
            $table->string('audience')->nullable()->after('date_of_birth');
        });

        // Drop the pivot table
        Schema::dropIfExists('audience_student');

        // Drop the audiences table
        Schema::dropIfExists('audiences');
    }
}