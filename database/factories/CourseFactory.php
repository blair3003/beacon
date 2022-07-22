<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->catchPhrase(),
            'code' => strtoupper($this->faker->unique()->lexify('???')),
            'description' => $this->faker->text(),
            'max_trainees' => 30,
            'cert_period' => 4
        ];
    }
}