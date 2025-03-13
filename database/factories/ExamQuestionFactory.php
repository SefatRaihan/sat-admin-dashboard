<?php

namespace Database\Factories;

use App\Models\ExamQuestion;
use App\Models\ExamSection;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamQuestionFactory extends Factory
{
    protected $model = ExamQuestion::class;

    public function definition()
    {
        return [
            'section_id' => ExamSection::inRandomOrder()->first()->id ?? ExamSection::factory(),
            'question_title' => $this->faker->sentence(),
            'question_description' => $this->faker->paragraph(),
            'question_text' => $this->faker->text(),
            'question_type' => $this->faker->randomElement(['MCQ', 'Fill-in-the-Blank', 'Paragraph']),
            'audience' => $this->faker->randomElement(['High School', 'College', 'Graduation', 'SAT 2']),
            'sat_type' => $this->faker->randomElement(['SAT 1', 'SAT 2']),
            'sat_question_type' => $this->faker->randomElement(['Physics', 'Chemistry', 'Biology', 'Math', 'Verbal', 'Quant']),
            'options' => json_encode([$this->faker->word, $this->faker->word, $this->faker->word, $this->faker->word]),
            'correct_answer' => $this->faker->word,
            'difficulty' => $this->faker->randomElement(['Easy', 'Medium', 'Hard', 'Very Hard']),
            'tags' => json_encode([$this->faker->word, $this->faker->word]),
            'explanation' => $this->faker->paragraph(),
            'images' => json_encode([$this->faker->imageUrl()]),
            'videos' => json_encode([$this->faker->url()]),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'created_by' => User::inRandomOrder()->first()->id ?? User::factory(),
            'updated_by' => User::inRandomOrder()->first()->id ?? User::factory(),
        ];
    }
}
