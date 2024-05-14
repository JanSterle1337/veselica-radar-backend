<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tablesPerEvent = 10;

        Event::all()->each(function ($event) use ($tablesPerEvent) {
            Table::factory($tablesPerEvent)->create(['event_id' => $event->id]);
        });
    }
}
