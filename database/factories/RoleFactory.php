<?php 

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Role;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        // Assign name first to use in slug
        $roleNames = ['Admin', 'Supervisor', 'Student'];
        $name = $roleNames[array_rand($roleNames)];

        return [
            'uuid' => (string) Str::uuid(), // ✅ Ensures a unique UUID
            'name' => $name, 
            'slug' => Str::slug($name), // ✅ Corrected slug generation
            'description' => $this->faker->sentence(),
            'is_supervisor_role' => $name === 'Supervisor', // ✅ Assign supervisor role correctly
            'created_by' => \App\Models\User::factory(), // ✅ Dynamically create and assign a user
        ];
    }
}
