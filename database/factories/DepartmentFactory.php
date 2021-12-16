<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\Types\AggregatedType;

class DepartmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
            return [
                'name' => $this->faker->word(),
                'description' => $this->faker->text('500'),
                'logo' => 'img-'.rand(1,15),
            ];
    }
}
