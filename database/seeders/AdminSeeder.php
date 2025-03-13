<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch the admin role
        $adminRole = Role::where('slug', 'admin')->first();
        
        if (!$adminRole) {
            $this->command->info('Admin role not found. Please run RoleSeeder first.');
            return;
        }

        // Create the admin user
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // Ensure uniqueness by email
            [
                'uuid' => Str::uuid(),
                'active_role_id' => $adminRole->id,
                'first_name' => 'Admin',
                'last_name' => 'User',
                'full_name' => 'Admin User',
                'email' => 'admin@example.com',
                'phone' => '1234567890',
                'password' => Hash::make('password'), // Change this in production
                'is_active' => true,
                'ip_address' => '127.0.0.1',
                'last_login' => now(),
                'profile_image' => null,
                'remember_token' => null,
            ]
        );
    }
}