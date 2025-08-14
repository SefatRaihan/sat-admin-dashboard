<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("ALTER TABLE exam_questions MODIFY difficulty ENUM('Very Easy', 'Easy', 'Medium', 'Hard', 'Very Hard') DEFAULT 'Medium'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE exam_questions MODIFY difficulty ENUM('Easy', 'Medium', 'Hard', 'Very Hard') DEFAULT 'Medium'");
    }
};

