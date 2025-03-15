<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exam;
use App\Models\ExamSection;

class ExamSeeder extends Seeder
{
    public function run()
    {
        // Create a few exams with their associated sections
        Exam::factory(10)->create()->each(function ($exam) {
            // Create multiple exam sections for each exam
            ExamSection::factory(3)->create(['exam_id' => $exam->id]);
        });
    }
}

