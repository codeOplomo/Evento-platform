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
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'event_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'location' => $this->faker->address,
            'category_id' => Category::factory(), // Creates a Category for each Event
            'organizer_id' => User::factory(), // Assumes Organizer is a User, creates a User for each Event
        ];
    }

}
