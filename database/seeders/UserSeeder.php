<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Fetch role IDs dynamically
        $roles = Role::whereIn('name', ['Admin', 'Supervisor', 'Student'])->pluck('id', 'name');

        // Ensure we have the roles
        if ($roles->count() < 3) {
            $this->command->warn('⚠️ Some roles are missing. Run the RoleTableSeeder first.');
            return;
        }

        // Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // Prevent duplicate admins
            [
                'uuid' => Str::uuid(),
                'first_name' => 'Admin',
                'last_name' => 'User',
                'full_name' => 'Admin User',
                'email' => 'admin@example.com',
                'phone' => '1234567890',
                'password' => Hash::make('adminpassword'), // Hash manually
                'active_role_id' => $roles['Admin'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create 5 Supervisors
        User::factory()->count(5)->create(['active_role_id' => $roles['Supervisor']]);

        // Create 20 Students
        User::factory()->count(5)->create(['active_role_id' => $roles['Student']]);
    }
}
