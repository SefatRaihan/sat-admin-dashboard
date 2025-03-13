<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin', 'slug' => 'admin', 'description' => 'Administrator with full access.', 'is_supervisor_role' => true],
            ['name' => 'Supervisor', 'slug' => 'supervisor', 'description' => 'Teacher who can manage exams and questions.', 'is_supervisor_role' => false],
            ['name' => 'Student', 'slug' => 'student', 'description' => 'Student who can take exams.', 'is_supervisor_role' => false],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['slug' => $role['slug']], // Ensure uniqueness by slug
                array_merge($role, ['uuid' => Str::uuid()]) // Auto-generate UUID
            );
        }
    }
}
