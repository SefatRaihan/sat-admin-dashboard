<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Admin', 'Supervisor', 'Teacher', 'Student'];

        foreach ($roles as $role) {
            Role::create([
                'uuid'          => Str::uuid(),
                'name'          => $role,
                'slug'          => Str::slug($role),
                'description'   => $role . ' role'
            ]);
        }
    }
}