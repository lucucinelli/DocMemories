<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FamiliarHistory>
 */
class FamiliarHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'allergy' => $this->faker->word(),
            'relative' => $this->faker->randomElement(['mother', 'father', 'sibling', 'grandparent']),
            'note' => $this->faker->sentence(),
            'patient_id' => $this->faker->randomElement(\App\Models\Patient::pluck('id')),
        ];
    }
}
