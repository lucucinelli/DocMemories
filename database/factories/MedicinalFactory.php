<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicinal>
 */
class MedicinalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'quantity' => $this->faker->randomNumber(),
            'usage' => $this->faker->word(),
            'period' => $this->faker->numberBetween(1, 30) . ' giorni',
            'visit_id' => $this->faker->randomElement(\App\Models\Visit::pluck('id')),
        ];
    }
}
