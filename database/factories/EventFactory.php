<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Ensure you have a user with the organizer role assigned.
        // This example assumes you have a method to retrieve such users.
        $organizer = User::whereHas('roles', function ($query) {
            $query->where('name', 'organizer');
        })->inRandomOrder()->first();

        $eventStartDate = $this->faker->dateTimeBetween('+1 week', '+1 month');

        // Randomly decide if the event should have an end date, 70% chance of having an end date
        $hasEndDate = $this->faker->boolean(70);

        // If the event has an end date, set it to a date between the start date and two months after the start date
        $eventEndDate = $hasEndDate ? $this->faker->dateTimeBetween($eventStartDate, '+1 months') : null;

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'event_date' => $eventStartDate,
            'end_date' => $eventEndDate, // Add this line
            'location' => $this->faker->city,
            'capacity' => $this->faker->randomElement([50, 100, 150]),
            'is_approved' => false,
            'category_id' => Category::factory(),
            'organizer_id' => $organizer ? $organizer->id : User::factory(),
        ];
    }

}
