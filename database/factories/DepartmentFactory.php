<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\Types\AggregatedType;

class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
            return [
                'name' => $this->faker->text('10'),
                'description' => $this->faker->text('150'),
                'logo' => 'img-'.rand(1,15),
            ];
    }
}
