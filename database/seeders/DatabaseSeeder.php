<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class, // Must be before EventSeeder
            CategorySeeder::class,
            EventSeeder::class, // Requires organizers to exist
            BookingSeeder::class,
            TicketSeeder::class,
        ]);
    }
}
