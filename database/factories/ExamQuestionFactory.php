<?php

namespace Database\Factories;

use App\Models\ExamQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ExamQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExamQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid,
            'audience' => $this->faker->randomElement(['High School', 'College', 'Graduation', 'SAT 2']),
            'sat_type' => $this->faker->randomElement(['SAT 1', 'SAT 2']),
            'sat_question_type' => $this->faker->randomElement(['Physics', 'Chemistry', 'Biology', 'Math', 'Verbal', 'Quant']),
            'question_title' => $this->faker->sentence,
            'question_description' => $this->faker->paragraph,
            'question_text' => $this->faker->paragraph,
            'question_type' => $this->faker->randomElement(['MCQ', 'Fill-in-the-Blank', 'Paragraph']),
            'options' => json_encode([
                'option_1' => $this->faker->word,
                'option_2' => $this->faker->word,
                'option_3' => $this->faker->word,
                'option_4' => $this->faker->word,
            ]),
            'correct_answer' => $this->faker->word,
            'difficulty' => $this->faker->randomElement(['Easy', 'Medium', 'Hard', 'Very Hard']),
            'tags' => json_encode([$this->faker->word, $this->faker->word]),
            'explanation' => $this->faker->paragraph,
            'version_number' => 1,
            'language_code' => $this->faker->randomElement(['en', 'es', 'fr', 'de']),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'images' => json_encode([$this->faker->imageUrl, $this->faker->imageUrl]),
            'videos' => json_encode([$this->faker->url, $this->faker->url]),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
