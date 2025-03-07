<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ExamQuestion;

class ExamQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ensure user with ID 1 (Admin) exists
        $admin = User::find(1);
        if (!$admin) {
            $this->command->warn('Admin user (ID 1) not found. Run AdminUserSeeder first.');
            return;
        }

        // Sample Exam Questions
        $questions = [
            [
                'question_title' => 'Basic Algebra Question',
                'question_description' => 'Solve for x in the equation: 2x + 3 = 7',
                'question_text' => 'What is the value of x in the equation 2x + 3 = 7?',
                'question_type' => 'MCQ',
                'audience' => 'High School',
                'sat_type' => 'SAT 1',
                'sat_question_type' => 'Math',
                'options' => json_encode(['x = 2', 'x = 3', 'x = 4', 'x = 5']),
                'correct_answer' => 'x = 2',
                'difficulty' => 'Easy',
                'tags' => json_encode(['algebra', 'math']),
                'explanation' => 'Subtract 3 from both sides and divide by 2.',
                'language_code' => 'en',
                'status' => 'active',
                'created_by' => $admin->id,
                'updated_by' => $admin->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'question_title' => 'Physics Motion Question',
                'question_description' => 'A ball is thrown vertically upwards with a speed of 20m/s. How long will it take to reach the highest point?',
                'question_text' => 'Using acceleration due to gravity as 10m/s², calculate the time taken to reach the highest point.',
                'question_type' => 'MCQ',
                'audience' => 'College',
                'sat_type' => 'SAT 2',
                'sat_question_type' => 'Physics',
                'options' => json_encode(['1 sec', '2 sec', '3 sec', '4 sec']),
                'correct_answer' => '2 sec',
                'difficulty' => 'Medium',
                'tags' => json_encode(['physics', 'motion']),
                'explanation' => 'Using v = u + at, set v = 0 and solve for t.',
                'language_code' => 'en',
                'status' => 'active',
                'created_by' => $admin->id,
                'updated_by' => $admin->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Insert each question using updateOrCreate to avoid duplicates
        foreach ($questions as $question) {
            ExamQuestion::updateOrCreate(
                ['question_text' => $question['question_text']],
                $question
            );
        }

        $this->command->info('Exam questions seeded successfully.');
    }
}
