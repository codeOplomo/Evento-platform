<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = [
            ['id' => 1, 'name' => 'admin'],
            ['id' => 2, 'name' => 'organiser'],
            ['id' => 3, 'name' => 'client'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['id' => $role['id']], ['name' => $role['name']]);
        }
    }
}
