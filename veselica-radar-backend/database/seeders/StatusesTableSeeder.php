<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Retrieve existing statuses and group them by user_id
        $existingStatuses = DB::table('statuses')->select('user_id', 'event_id')->get()->groupBy('user_id')->map(function ($statuses) {
            return $statuses->pluck('event_id')->toArray();
        })->toArray();

        // Retrieve all user and event IDs
        $userIds = DB::table('users')->pluck('id')->all();
        $eventIds = DB::table('events')->pluck('id')->all();

        // Loop to create multiple status records
        $numberOfStatuses = 30; // You can adjust this number as needed

        for ($i = 0; $i < $numberOfStatuses; $i++) {
            // Get random user and event IDs
            $userId = $userIds[array_rand($userIds)];
            $eventId = $eventIds[array_rand($eventIds)];

            // Check if a record with the same user_id and event_id already exists
            $existingRecord = DB::table('statuses')->where('user_id', $userId)->where('event_id', $eventId)->exists();
            if (!$existingRecord) {
                // Generate a random status
                $status = rand(0, 1) ? 'Going' : 'Not Going'; // Assuming 'Going' or 'Not Going'

                // Create a new Status record
                DB::table('statuses')->insert([
                    'user_id' => $userId,
                    'event_id' => $eventId,
                    'status' => $status,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Update existingStatuses array to prevent duplicates
                $existingStatuses[$userId][] = $eventId;
            }
        }
    }
}
