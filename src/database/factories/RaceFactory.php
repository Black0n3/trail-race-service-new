<?php

namespace Database\Factories;

use App\Enums\RaceDistanceEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Race>
 */
class RaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Race by: '.fake()->lastName(),
            'distance' => fake()->randomElement(RaceDistanceEnum::cases())->value,
        ];
    }
}
