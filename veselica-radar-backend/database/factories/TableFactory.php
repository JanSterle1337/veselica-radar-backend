<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $randomEvent = Event::inRandomOrder()->first();


        return [
            'name' => $this->faker->unique()->numberBetween(1, 1000),
            'event_id' => function() {
                return Event::inRandomOrder()->first()->id;
            }
        ];
    }
}
