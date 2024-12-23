<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Floor;
use App\Models\Room;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $floors = Floor::all();

        foreach ($floors as $floor) {

            for ($i = 1; $i <= 5; $i++) {
                Room::create([
                    'name' => "Room $i",
                    'floor_id' => $floor->id, // Assign the building ID
                ]);
            }
        }
    }
}
