<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

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

    public function definition(): array
    {

        $location = fake()->streetName();
        $isEntranceFee = fake()->boolean();
        $entranceFee = 0;
        if ($isEntranceFee) {
            $entranceFee = fake()->randomFloat([1],[20]);
        }


        $startingHour = fake()->time('H:i');
        $endingHour = fake()->time('H:i');

        return [
            'name' => $location . " veselica",
            'location' => $location,
            'entrance_fee' => $entranceFee,
            'event_date' => fake()>date('Y-m-d'),
            'starting_hour' => $startingHour,
            'ending_hour' => $endingHour,
        ];
    }

}
