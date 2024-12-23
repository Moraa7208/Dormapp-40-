<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Assignment;
use App\Models\User;
use App\Models\Room;
use Carbon\Carbon;


class AssignmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = Room::all();

        foreach ($rooms as $room) {
            // Get all students in the current room
            $students = User::where('room_id', $room->id)->get();

            for ($i = 1; $i <= 7; $i++) { // For 30 days (one month)
                $student = $students->random(); // Random student from the room

                // Randomly select a status
                $statuses = ['is pending for', 'user did not clean', 'Bad cleaned', 'Well cleaned', 'Rest Day'];
                $status = $statuses[array_rand($statuses)];

                Assignment::create([
                    'user_id' => $student->id,
                    'room_id' => $room->id,
                    'cleaning_date' => Carbon::now()->subDays(7 - $i)->format('Y-m-d'), // Date within the past month
                    'status' => $status, // Random status
                ]);
            }
        }
    }
}
