<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ipAddress = getHostByName(getHostName());
        $roles = Role::pluck('id', 'name');

        $users = [
            [
                'first_name'    => 'Super',
                'last_name'     => 'Admin',
                'email'         => 'admin@gmail.com',
                'phone'         => '1234567890',
                'password'      => Hash::make('password'),
                'role'          => 'Admin'
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'uuid'              => Str::uuid(),
                'first_name'        => $user['first_name'],
                'last_name'         => $user['last_name'],
                'full_name'         => $user['first_name'] . ' ' . $user['last_name'],
                'email'             => $user['email'],
                'phone'             => $user['phone'],
                'password'          => $user['password'],
                'active_role_id'    => $roles[$user['role']] ?? null,
                'is_active'         => true,
                'ip_address'        => $ipAddress,
                'last_login'        => now(),
            ]);
        }
    }
}
