<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exam;
use App\Models\ExamSection;
use App\Models\ExamQuestion;

class ExamSeeder extends Seeder
{
    public function run()
    {
        // Create 5 exams
        Exam::factory(5)->create()->each(function ($exam) {
            // Create 3 sections per exam
            ExamSection::factory(3)->create(['exam_id' => $exam->id])->each(function ($section) {
                // Create 10 questions per section
                ExamQuestion::factory(10)->create(['section_id' => $section->id]);
            });
        });
    }
}
