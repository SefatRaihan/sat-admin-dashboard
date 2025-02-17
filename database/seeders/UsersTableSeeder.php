<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name'=>'Super Admin',
                'active_role_id'=>1,
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('password-1')
            ]
        ];
        DB::table('users')->insert($user);
    }
}