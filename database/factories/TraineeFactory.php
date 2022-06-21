<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trainee>
 */
class TraineeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'job' => $this->faker->jobTitle(),
            'email' => $this->faker->email(),
            'mobile' => $this->faker->e164PhoneNumber(),
            'tel' => $this->faker->phoneNumber(),
            'address_1' => $this->faker->buildingNumber(),
            'address_2' => $this->faker->streetName(),
            'address_3' => $this->faker->secondaryAddress(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'zip' => $this->faker->postcode()
        ];
    }
}
