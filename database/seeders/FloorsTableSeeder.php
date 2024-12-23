<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Building;
use App\Models\Floor;
use App\Models\User;

class FloorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::role('floor_manager')->get();
        $buildings = Building::all();

        foreach ($buildings as $building) {
            // Create 5 floors for each building
            for ($i = 1; $i <= 5; $i++) {
                // Ensure there are floor managers available
                $floor_manager = $users->random(); // Pick a random floor manager

                // Create a floor and associate it with the building
                Floor::create([
                    'name' => "Floor $i",
                    'manager_id' => $floor_manager->id,
                    'building_id' => $building->id, // Assign the building ID
                ]);
            }
        }
    }
}
