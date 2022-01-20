<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'no_department'   => 'DPM' . rand(1,100),
            'type_department' => $this->faker->numberBetween(1, 3),
            'status'          => $this->faker->numberBetween(1, 2),
            'description'     => $this->faker->text(100),
            'square_meters'   => $this->faker->numberBetween(100, 200),
        ];
    }
}
