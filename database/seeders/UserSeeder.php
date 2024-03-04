<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create an admin
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
        ]);
        $adminRole = Role::where('name', 'admin')->first();
        $admin->roles()->attach($adminRole);

        // Create an organiser
        $organiser = User::factory()->create([
            'email' => 'organiser@example.com',
        ]);
        $organiserRole = Role::where('name', 'organiser')->first();
        $organiser->roles()->attach($organiserRole);

        // Create a client
        $client = User::factory()->create([
            'email' => 'client@example.com',
        ]);
        $clientRole = Role::where('name', 'client')->first();
        $client->roles()->attach($clientRole);

        // Optionally, create more users as needed
        User::factory(10)->create()->each(function ($user) {
            // Randomly assign roles to users
            $roles = Role::whereIn('name', ['organiser', 'client'])->get();
            $user->roles()->attach($roles->random());
        });
    }
}
