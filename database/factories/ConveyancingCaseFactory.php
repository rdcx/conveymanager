<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConveyancingCase>
 */
class ConveyancingCaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => \App\Models\Property::factory(),
            'conveyancer_id' => \App\Models\User::factory([
                'role' => 'conveyancer',
            ]),
            'status' => fake()->randomElement(['initiated', 'in_progress', 'completed']),
            'start_date' => fake()->dateTimeBetween('now', '+1 year'),
        ];
    }
}
