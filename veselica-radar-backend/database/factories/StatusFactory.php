<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Event;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Status>
 */
class StatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomUser = User::inRandomOrder()->first();
        $randomEvent = Event::inRandomOrder()->first();

        return [
            'userId' => $randomUser->id,
            'eventId' => $randomEvent->id,
            'status' => $this->faker->randomElement(['Going', 'Not Going'])
        ];
    }
}
