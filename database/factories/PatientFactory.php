<?php

namespace Database\Factories;

use App\Models\User;
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

        $gender = $this->faker->randomElement(['M', 'F', 'M', 'F', 'M', 'F', 'M', 'F', 'non specificato']);
        switch ($gender){
            case 'M':
                $name = $this->faker->firstName('male');
                break;
            case 'F':
                $name = $this->faker->firstName('female');
                break;
            default:
                $name = $this->faker->firstName();
        }
        return [
            'name' => $name,
            'surname' => $this->faker->lastName(),
            'birthdate' => $this->faker->date(max: now()->subDecades(1)),
            'gender' => $gender,
            'birthplace' => $this->faker->city(),
            'tax_code' => $this->faker->unique()->regexify('^[A-Z]{6}[0-9]{2}[A-EHLMPR-T][0-9]{2}[A-Z][0-9]{3}[A-Z]$'),
            'marital_status' => $this->faker->randomElement(['Single', 'Sposato', 'Divorziato']),
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
            'user_id' => $this->faker->randomElement(User::pluck('id')),

        ];
    }
}
