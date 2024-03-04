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

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'event_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'location' => $this->faker->city,
            'category_id' => Category::factory(), // This line remains unchanged
            'organizer_id' => $organizer ? $organizer->id : User::factory(), // Pick a random organizer or create a new user
        ];
    }

}
