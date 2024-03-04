<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $organizers = User::whereHas('roles', function ($query) {
            $query->where('name', 'organizer'); // Adjust the condition based on how you've implemented roles
        })->get();

        if ($organizers->isEmpty()) {
            return; // No organizers to assign events to
        }

        foreach (range(1, 50) as $index) {
            $organizer = $organizers->random(); // Pick a random organizer
            Event::factory()->create([
                'organizer_id' => $organizer->id,
            ]);
        }
    }
}
