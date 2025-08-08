<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PhysiologicalHistory>
 */
class PhysiologicalHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'birth' => $this->faker->word(),
            'atopy' => $this->faker->boolean(),
            'nursing' => $this->faker->word(),
            'diet' => $this->faker->sentence(),
            'habits' => $this->faker->sentence(),
            'period' => $this->faker->word(),
            'period_regularity' => $this->faker->word(),
            'patient_id' => $this->faker->randomElement(\App\Models\Patient::pluck('id')),
        ];
    }
}
