<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid(),
            'user_id' => $this->faker->optional()->randomNumber(),
            'name' => $this->faker->name(),
            'student_code' => $this->faker->unique()->bothify('??#####'),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'date_of_birth' => $this->faker->date(),
            'audience' => $this->faker->optional()->word(),
            'image' => $this->faker->optional()->imageUrl(),
            'package' => 'super-man', // Default value
            'duration' => 'monthly', // Default value
            'status' => 'active', // Default value
            'created_by' => $this->faker->optional()->randomNumber(),
            'updated_by' => $this->faker->optional()->randomNumber(),
            'deleted_by' => $this->faker->optional()->randomNumber(),
        ];
    }
}
