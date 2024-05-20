<?php

namespace Database\Factories;

use App\Models\User;
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

        $userIds = User::pluck('id')->toArray();

        $userId = fake()->randomElement($userIds);

        $location = fake()->streetName();
        $isEntranceFee = fake()->boolean();
        $isConfirmed = fake()->boolean();
        $entranceFee = 0;
        if ($isEntranceFee) {
            $entranceFee = fake()->randomFloat([1],[20]);
        }


        $startingHour = fake()->time('H:i');
        $endingHour = fake()->time('H:i');

        $latitude = fake()->latitude(45.674424, 46.3694);
        $longitude = fake()->longitude(13.9167, 15.56735);

        return [
            'name' => $location . " veselica",
            'location' => $location,
            'entrance_fee' => $entranceFee,
            'is_confirmed' => $isConfirmed,
            'event_date' => fake()>date('Y-m-d'),
            'starting_hour' => $startingHour,
            'ending_hour' => $endingHour,
            'user_id' => $userId,
            'latitude' => $latitude,
            'longitude' => $longitude,
        ];
    }

}
