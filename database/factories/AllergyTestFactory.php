<?php

namespace Database\Factories;

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
        return [
            'test_date' => $this->faker->date(),
            'test_type' => $this->faker->word(),
            'test_result' => $this->faker->word(),
            'test_note' => $this->faker->sentence(),
            'visit_id' => $this->faker->randomElement(\App\Models\Visit::pluck('id')),
        ];
    }
}
