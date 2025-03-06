<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            // `id` is auto-generated
            'uuid' => (string) Str::uuid(), // ✅ Ensure UUID is properly set
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'role_id' => Role::first()->id ?? Role::factory()->create()->id, // ✅ Ensure a valid role_id (BIGINT)
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
