<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'uuid' => (string) Str::uuid(),
            'user_id' => User::first()->id ?? User::factory()->create()->id, // ✅ Uses BIGINT for user_id
        ];
    }
}
