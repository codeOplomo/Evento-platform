<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $clients = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->get();

        $events = Event::all();

        foreach ($events as $event) {
            // Assuming each event will have bookings from 1 to 5 different clients
            $clients->random(rand(1, 5))->each(function ($client) use ($event) {
                Booking::factory()->create([
                    'user_id' => $client->id,
                    'event_id' => $event->id,
                    'status' => 'confirmed', // Or randomize
                ]);
            });
        }
    }
}
