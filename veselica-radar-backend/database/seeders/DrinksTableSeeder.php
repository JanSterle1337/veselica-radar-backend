<?php

namespace Database\Seeders;

use App\Models\Drink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DrinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define the drinks data
        $drinks = [
            [
                'name' => 'Cola',
                'description' => 'Refreshing cola drink',
                'volume' => 0.33,
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'name' => 'Orange Juice',
                'description' => 'Freshly squeezed orange juice',
                'volume' => 0.5,
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'name' => 'Water',
                'description' => 'Pure drinking water',
                'volume' => 0.5,
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'name' => 'Whiskey',
                'description' => 'A classic distilled spirit',
                'volume' => 0.7,
            ],
            [
                'name' => 'Stockcola',
                'description' => 'A popular cola drink',
                'volume' => 0.33,
            ],
            [
                'name' => 'Sex on the Beach',
                'description' => 'A fruity cocktail with vodka, peach schnapps, orange juice, and cranberry juice',
                'volume' => 0.3,
            ],
            // Add more drinks as needed
        ];

        // Insert drinks into the database
        foreach ($drinks as $drinkData) {
            DB::table('drinks')->insert($drinkData);
        }
    }
}
