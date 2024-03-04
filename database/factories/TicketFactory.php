<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'booking_id' => Booking::factory(),
            'code' => $this->faker->unique()->bothify('Ticket-####-????'),
            'status' => $this->faker->randomElement(['valid', 'used', 'expired']),
            'expiration_date' => $this->faker->dateTimeBetween('+1 month', '+6 months'),
        ];
    }

}
