<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExamFactory extends Factory
{
    protected $model = Exam::class;

    public function definition()
    {
        return [
            'uuid' => Str::uuid(),
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'scheduled_at' => now()->addDays(rand(1, 30)),
            'duration' => rand(30, 180), // Duration in minutes
            'created_by' => User::inRandomOrder()->first()->id ?? User::factory(),
            'updated_by' => User::inRandomOrder()->first()->id ?? User::factory(),
        ];
    }
}
