<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => $this->faker->company,
            'model' => $this->faker->word,
            'plate' => strtoupper($this->faker->bothify('?? ###')),
            'color' => $this->faker->safeColorName,
            'year' => $this->faker->year,
            'km' => $this->faker->numberBetween(0, 300000),
            'is_active' => $this->faker->boolean,
        ];
    }
}
