<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = [
            ['id' => 1, 'name' => 'Admin', 'slug' => 'admin'],
            ['id' => 2, 'name' => 'Student', 'slug' => 'student'],
            ['id' => 3, 'name' => 'Adviser', 'slug' => 'adviser'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['id' => $role['id']],
                [
                    'uuid' => Str::uuid(),
                    'name' => $role['name'],
                    'slug' => $role['slug'],
                ]
            );
        }
    }
}
