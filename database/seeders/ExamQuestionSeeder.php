<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExamQuestion;

class ExamQuestionSeeder extends Seeder
{
    public function run()
    {
        ExamQuestion::factory()->count(5)->create(); // Generate 5 dummy questions
    }
}
