<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NextPathologicalHistory>
 */
class NextPathologicalHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'type' => $this->faker->randomElement(['respiratoria', 'dermatologica', 'alimentare', 'farmacologica', 'veleno di imenotteri']),
            'name' => '',
            'cause' => $this->faker->word(),
            'effect' => $this->faker->word(),
            'note' => $this->faker->sentence(),
            'patient_id' => $this->faker->randomElement(\App\Models\Patient::pluck('id')),
        ];
    }
}
