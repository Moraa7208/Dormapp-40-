<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Building;
use App\Models\User;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::role('building_manager')->get();

        for ($i=1; $i <= 2; $i++) {
            $building_manager = $users->random();
            Building::create([
                'name' => "Building $i",
                'address' => "Address for Building $i",
                'manager_id' => $building_manager->id,
            ]);
        }
    }
}
