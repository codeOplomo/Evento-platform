<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::whereHas('roles', function ($query) {
                    $query->where('name', 'client');
                })->inRandomOrder()->first()->id ?? User::factory(),
            'event_id' => Event::factory(),
            'status' => $this->faker->randomElement(['confirmed', 'pending', 'cancelled']),
            'number_of_tickets' => $this->faker->numberBetween(1, 5),
        ];
    }

}
