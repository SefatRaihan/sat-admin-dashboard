<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\ExamSection;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExamSectionFactory extends Factory
{
    protected $model = ExamSection::class;

    public function definition()
    {
        return [
            'uuid' => Str::uuid(),
            'exam_id' => Exam::inRandomOrder()->first()->id ?? Exam::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'duration' => rand(15, 60), // Section duration in minutes
            'created_by' => User::inRandomOrder()->first()->id ?? User::factory(),
            'updated_by' => User::inRandomOrder()->first()->id ?? User::factory(),
        ];
    }
}
