<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Course;
use App\Models\Event;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test the events index route.
     *
     * @return void
     */
    public function test_events_index_route_returns_index_view()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('events.index'));
        $response->assertStatus(200);
        $response->assertViewIs('events.index');
    }

    /**
     * Test the events create route.
     *
     * @return void
     */
    public function test_events_create_route_returns_create_view()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('events.create'));
        $response->assertStatus(200);
        $response->assertViewIs('events.create');
    }

    /**
     * Test the events show route.
     *
     * @return void
     */
    public function test_events_show_route_returns_show_view()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();
        
        $response = $this->actingAs($user)->get(route('events.show', $event));
        $response->assertStatus(200);
        $response->assertViewIs('events.show', $event);
    }

    /**
     * Test the events edit route.
     *
     * @return void
     */
    public function test_events_edit_route_returns_edit_view()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();
        
        $response = $this->actingAs($user)->get(route('events.edit', $event));
        $response->assertStatus(200);
        $response->assertViewIs('events.edit', $event);
    }

    /**
     * Test the events store route.
     *
     * @return void
     */
    public function test_events_store_route_stores_event()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $venue = Venue::factory()->create();

        $start = $this->faker->dateTimeBetween('-1 years', '+1 years');
        $end = $this->faker->dateTimeBetween($start, $start->format('Y-m-d H:i:s') . ' +2 days +2 hours');
        
        $response = $this->actingAs($user)->post(route('events.store'), [
            'course_id' => $course->id,
            'venue_id' => $venue->id,
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
            'start_time' => $start->format('H:i'),
            'end_time' => $end->format('H:i')
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Event created!');
    }

    /**
     * Test the events store route with start date after end date.
     *
     * @return void
     */
    public function test_events_store_route_only_stores_end_dates_after_start()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $venue = Venue::factory()->create();

        $end = $this->faker->dateTimeBetween('-1 years', '+1 years');
        $start = $this->faker->dateTimeBetween($end, $end->format('Y-m-d H:i:s') . ' +2 days +2 hours');

        // fwrite(STDERR, print_r('Start ', TRUE));
        // fwrite(STDERR, print_r($start, TRUE));
        // fwrite(STDERR, print_r('End ', TRUE));
        // fwrite(STDERR, print_r($end, TRUE));
        
        $response = $this->actingAs($user)->post(route('events.store'), [
            'course_id' => $course->id,
            'venue_id' => $venue->id,
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
            'start_time' => $start->format('H:i'),
            'end_time' => $end->format('H:i')
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('end_date');
    }

    /**
     * Test the events update route.
     *
     * @return void
     */
    public function test_events_update_route_updates_event()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();

        $start = $this->faker->dateTimeBetween('-1 years', '+1 years');
        $end = $this->faker->dateTimeBetween($start, $start->format('Y-m-d H:i:s') . ' +2 days +2 hours');
        
        $response = $this->actingAs($user)->put(route('events.update', $event), [
            'course_id' =>  Course::factory()->create()->id,
            'venue_id' => Venue::factory()->create()->id,
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
            'start_time' => $start->format('H:i'),
            'end_time' => $end->format('H:i')
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Event updated!');
    }

    /**
     * Test the events update route with start date after end date.
     *
     * @return void
     */
    public function test_events_update_route_only_updates_end_dates_after_start()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();

        $end = $this->faker->dateTimeBetween('-1 years', '+1 years');
        $start = $this->faker->dateTimeBetween($end, $end->format('Y-m-d H:i:s') . ' +2 days +2 hours');

        // fwrite(STDERR, print_r('Start ', TRUE));
        // fwrite(STDERR, print_r($start, TRUE));
        // fwrite(STDERR, print_r('End ', TRUE));
        // fwrite(STDERR, print_r($end, TRUE));
        
        $response = $this->actingAs($user)->put(route('events.update', $event), [
            'course_id' =>  Course::factory()->create()->id,
            'venue_id' => Venue::factory()->create()->id,
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
            'start_time' => $start->format('H:i'),
            'end_time' => $end->format('H:i')
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('end_date');
    }

    /**
     * Test the events destroy route.
     *
     * @return void
     */
    public function test_events_destroy_route_removes_event()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();
        
        $response = $this->actingAs($user)->delete(route('events.destroy', $event));

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Event removed!');
    }

}
