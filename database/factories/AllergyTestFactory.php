<?php

namespace Database\Factories;

use App\Models\Visit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AllergyTest>
 */
class AllergyTestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $visitId = $this->faker->randomElement(\App\Models\Visit::pluck('id'));
        $data = Visit::find($visitId)->visit_date;
        $tests = [
            'PRICK: pollini', 
            'PRICK: alimenti', 
            'PRICK BY PRICK' , 
            'CUTI: farmaci', 
            'CUTI: imenotteri', 
            'CUTI: PPL/MDM', 
            'PATCH TEST: sidapa',
            'PATCH TEST: metalli', 
            'PATCH TEST: alimenti', 
            'PATCH TEST: gomma', 
            'PATCH TEST: parrucchiera', 
            'PATCH TEST: farmaci',
            'PCT',
            'TEO', 
            'TSA'
        ];
        $result = [
            '+',
            '++',
            '+++',
            '++++'
        ];
        return [
            'test_date' => $this->faker->dateTimeBetween($data, 'now')->format('Y-m-d'),
            'test_type' => $this->faker->randomElement($tests),
            'test_result' => $this->faker->randomElement($result),
            'test_note' => $this->faker->sentence(),
            'visit_id' => $visitId,
        ];
    }
}
