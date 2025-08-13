<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visit>
 */
class VisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $patient = $this->faker->randomElement(Patient::pluck('id'));
        $patient = Patient::find($patient);
        $farmaci = [
            'aspirina',
            'antibiotici',
            'antinfiammatori',
            'betalattamici',
            'cefalsporine',
            ''
        ];
        $veleni = [
            'vespa',
            'vespa cabro',
            'ape',
            'polistes dominulus',
            'veleno di imenotteri',
            ''
        ];
        $dermatitis = [
            'nichel',
            'irritativva',
            'cobalto cloruro',
            'parafenilendiammina',
            'orticaria',
            'angioedema',
            'mastocitosi',
            'varicosi',
            ''
        ];
        $varie = [
            'rinite',
            'asma',
            'congiuntivite',
            'poliposi nasale',
            'latte',
            'uova',
            'pesce',
            'frutta secca',
            'alimenti',
            ''
        ];
        return [
            'visit_date' => $this->faker->dateTimeBetween('1990-01-01', 'now')->format('Y-m-d'),
            'reason' => $this->faker->sentence(),
            'diagnosis' => $this->faker->randomElement($farmaci) . ' ' . $this->faker->randomElement($veleni) . ' ' . $this->faker->randomElement($dermatitis) . ' ' . $this->faker->randomElement($varie),
            'reservation' => $this->faker->randomElement(['Istituzionale','Intramoenia']),
            'note' => $this->faker->paragraph(),
            'user_id' => $patient->user_id,
            'patient_id' => $patient->id,
        ];
    }
}
