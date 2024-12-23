<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AssignmentReview;
use App\Models\User;
use App\Models\Assignment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AssignmentReview>
 */
class AssignmentReviewFactory extends Factory
{
    protected $model = \App\Models\AssignmentReview::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'assignment_id' => Assignment::factory(),
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement(['accepted', 'doubt', 'not_accepted']),
            'comment' => $this->faker->sentence(),
        ];
    }
}
