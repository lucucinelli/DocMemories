<?php

namespace Database\Factories;

use App\Models\Patient;
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
        $patient = $this->faker->randomElement(\App\Models\Patient::pluck('id'));
        $patient = Patient::find($patient);
        if ($patient->gender === 'F'){
            $period = $this->faker->word();
            $period_regularity = $this->faker->word();
        } else{
            $period = null;
            $period_regularity = null;
        }
        return [
            'birth' => $this->faker->word(),
            'atopy' => $this->faker->boolean(),
            'nursing' => $this->faker->word(),
            'diet' => $this->faker->sentence(),
            'habits' => $this->faker->sentence(),
            'period' => $period,
            'period_regularity' => $period_regularity,
            'patient_id' => $patient->id,
        ];
    }
}
