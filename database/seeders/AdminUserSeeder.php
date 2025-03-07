<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ensure the admin role exists
        $adminRole = Role::where('slug', 'admin')->first();
        if (!$adminRole) {
            $this->command->warn('Admin role not found. Run RoleSeeder first.');
            return;
        }

        // Create or update the admin user
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // Ensure admin email is unique
            [
                'uuid' => Str::uuid(),
                'first_name' => 'Admin',
                'last_name' => 'User',
                'full_name' => 'Admin User',
                'phone' => '1234567890', // Ensure uniqueness
                'email' => 'admin@example.com',
                'password' => Hash::make('password'), // Securely hash password
                'active_role_id' => $adminRole->id, // Fetch dynamically
                'is_active' => true,
                'ip_address' => request()->ip() ?? '127.0.0.1',
                'last_login' => now(),
                'profile_image' => null,
            ]
        );
    }
}
