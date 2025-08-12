<?php

namespace Database\Factories;

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
            'visit_date' => $this->faker->dateTimeBetween('2000-01-01', 'now')->format('Y-m-d'),
            'reason' => $this->faker->sentence(),
            'diagnosis' => $this->faker->randomElement($farmaci) . ' ' . $this->faker->randomElement($veleni) . ' ' . $this->faker->randomElement($dermatitis) . ' ' . $this->faker->randomElement($varie),
            'reservation' => $this->faker->randomElement(['Istituzionale','Intramoenia']),
            'note' => $this->faker->paragraph(),
            'user_id' => $this->faker->randomElement(\App\Models\User::pluck('id')),
            'patient_id' => $this->faker->randomElement(\App\Models\Patient::pluck('id')),
        ];
    }
}
