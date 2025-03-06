<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Ensure at least one user exists before assigning created_by
        $user = User::first() ?? User::factory()->create();

        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Supervisor'],
            ['name' => 'Student'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role['name']], // Avoid duplicate roles
                [
                    'uuid' => Str::uuid(),
                    'slug' => Str::slug($role['name']),
                    'description' => ucfirst($role['name']) . ' role',
                    'is_supervisor_role' => $role['name'] === 'Supervisor',
                    'created_by' => $user->id, // Assign a valid user
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
