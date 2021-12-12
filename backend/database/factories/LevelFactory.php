<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $level = $this->faker->randomElement(['Júnior', 'Pleno', 'Sênior']);
        return [
            'level' => $level
        ];
    }
}
