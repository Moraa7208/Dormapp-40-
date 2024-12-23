<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Assignment;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignment>
 */
class AssignmentFactory extends Factory
{
     protected $model = \App\Models\Assignment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses  = ['is pending for', 'user did not clean', 'Bad cleaned', 'Well cleaned', 'Rest Day'];

        return [
            'user_id' => User::factory(),
            'room_id' => Room::factory(),
            'cleaning_date' => $this->faker->date(),
            'status' => $statuses[array_rand($statuses)],
        ];
    }
}
