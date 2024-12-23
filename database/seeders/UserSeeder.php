<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Room;
use Faker\Factory as Faker;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $director = User::factory()->create([
        //     'name' => 'Director User',
        //     'email' => 'director@example.com',
        //     'password' => Hash::make('password'),
        // ]);
        // $director->assignRole('director');

        // for ($i=1; $i <= 2; $i++) {
        //     $buildingManager = User::factory()->create([
        //         'name' => "Building Manager $i",
        //         'email' => "building_manager$i@example.com",
        //         'password' => Hash::make('password'),
        //     ]);
        //     $buildingManager->assignRole('building_manager');
        // }

        // for ($i = 1; $i <= 10; $i++) {
        //     $floorManager = User::factory()->create([
        //         'name' => "Floor Manager $i",
        //         'email' => "floor_manager$i@example.com",
        //         'password' => Hash::make('password'),
        //     ]);
        //     $floorManager->assignRole('floor_manager');
        // }
        $faker = Faker::create();
        $rooms = Room::all();

        foreach ($rooms as $room) {
            for ($i = 1; $i <= 6; $i++) {
                $student = User::factory()->create([
                    'name' => $faker->name(),
                    'email' => $faker->unique()->safeEmail(),
                    'password' => Hash::make('password'),
                    'room_id' => $room->id,
                ]);
                $student->assignRole('student');
            }
        }
    }
}
