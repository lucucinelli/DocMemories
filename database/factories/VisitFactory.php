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
        $diagnosi = [
            'vespa',
            'mal di testa',
            'influenza',
            'raffreddore',
            'dolore alla schiena'
        ];
        return [
            'visit_date' => $this->faker->date(),
            'reason' => $this->faker->sentence(),
            'diagnosis' => $this->faker->randomElement($diagnosi),
            'reservation' => $this->faker->sentence(),
            'note' => $this->faker->paragraph(),
            'user_id' => $this->faker->randomElement(\App\Models\User::pluck('id')),
            'patient_id' => $this->faker->randomElement(\App\Models\Patient::pluck('id')),
        ];
    }
}
