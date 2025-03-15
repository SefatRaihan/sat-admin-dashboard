<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\User;
use App\Models\ExamSection;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExamSection>
 */
class ExamSectionFactory extends Factory
{
    protected $model = ExamSection::class;

    public function definition()
    {
        return [
            'uuid' => Str::uuid(),
            'exam_id' => Exam::factory(), // Creates a new Exam and associates with the ExamSection
            'audience' => $this->faker->randomElement(['High School', 'College', 'Graduation', 'SAT 2']),
            'section_type' => $this->faker->randomElement(['Physics', 'Chemistry', 'Biology', 'Math', 'Verbal', 'Quant']),
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'num_of_question' => $this->faker->numberBetween(5, 50),
            'duration' => $this->faker->numberBetween(30, 120), // Duration in minutes
            'section_order' => $this->faker->numberBetween(1, 5),
            'created_by' => 1,
            'updated_by' => 1,
            'deleted_by' => 1,
        ];
    }
}
