<?php

namespace Database\Factories;

use App\Models\Patient;
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
        $patientId = $this->faker->randomElement(\App\Models\Patient::pluck('id'));
        $data = Patient::find($patientId)->birthdate;
        return [
            'date' => $this->faker->dateTimeBetween($data, 'now')->format('Y-m-d'),
            'type' => $this->faker->randomElement(['respiratoria', 'dermatologica', 'alimentare', 'farmacologica', 'veleno di imenotteri']),
            'name' => '',
            'cause' => $this->faker->word(),
            'effect' => $this->faker->word(),
            'note' => $this->faker->sentence(),
            'patient_id' => $patientId,
        ];
    }
}
