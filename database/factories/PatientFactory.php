<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'birthdate' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['M', 'F', 'non specificato']),
            'birthplace' => $this->faker->city(),
            'tax_code' => $this->faker->unique()->regexify('^[A-Z]{6}[0-9]{2}[A-EHLMPR-T][0-9]{2}[A-Z][0-9]{3}[A-Z]$'),
            'marital_status' => $this->faker->randomElement(['Single', 'Married', 'Divorced']),
            'nationality' => $this->faker->country(),
            'city' => $this->faker->city(),
            'province' => $this->faker->regexify('^[A-Z]{2}$'),
            'address' => $this->faker->streetAddress(),
            'street_number' => $this->faker->buildingNumber(),
            'zip_code' => $this->faker->regexify('^[0-9]{5}$'),
            'domicile_city' => $this->faker->city(),
            'domicile_province' => $this->faker->regexify('^[A-Z]{2}$'),
            'domicile_address' => $this->faker->streetAddress(),
            'domicile_street_number' => $this->faker->buildingNumber(),
            'domicile_zip_code' => $this->faker->regexify('^[0-9]{5}$'),
            'telephone' => $this->faker->unique()->numerify('3## #######'),
            'email' => $this->faker->unique()->safeEmail(),
            'occupation' => $this->faker->word(),
        ];
    }
}
