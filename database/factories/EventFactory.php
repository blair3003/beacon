<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;
use App\Models\Venue;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $start = $this->faker->dateTimeBetween('-1 years', '+1 years');
        $end = $this->faker->dateTimeBetween($start, $start->format('Y-m-d H:i:s') . ' +2 days +2 hours');

        return [
            'course_id' => Course::all()->random()->id,
            'venue_id' => Venue::all()->random()->id,
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
            'start_time' => $start->format('H:i:s'),
            'end_time' => $end->format('H:i:s'),
            'notes' => $this->faker->text(),
        ];
    }
}
