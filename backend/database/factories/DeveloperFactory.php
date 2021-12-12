<?php

namespace Database\Factories;

use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeveloperFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['M', 'F']);
        return [
            'name' => $this->faker->name(),
            'gender' => $gender,
            'birth' => $this->faker->dateTimeBetween('1990-01-01', '2021-12-31')->format('Y-m-d'),
            'age' => rand(5, 60),
            'hobby' => $this->faker->sentence(10),
            'level_id' => Level::factory(),
        ];
    }
}
