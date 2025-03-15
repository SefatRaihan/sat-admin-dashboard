<?php

namespace Database\Factories;

use App\Models\Exam;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    protected $model = Exam::class;

    public function definition()
    {
        return [
            'uuid' => Str::uuid(),
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'scheduled_at' => $this->faker->dateTime(),
            'duration' => $this->faker->numberBetween(30, 180), // Duration in minutes
        ];
    }
}
