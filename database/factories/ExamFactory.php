<?php

namespace Database\Factories;

use App\Models\Visit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
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
        return [
            'date' => $this->faker->dateTimeBetween($data, 'now')->format('Y-m-d'),
            'type' => $this->faker->word(),
            'note' => $this->faker->sentence(),
            'result' => $this->faker->word(),
            'visit_id' => $visitId,
        ];
    }
}
