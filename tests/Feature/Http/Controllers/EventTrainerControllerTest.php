<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Course;
use App\Models\Event;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTrainerControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the event trainer index route.
     *
     * @return void
     */
    public function test_event_trainer_index_route_returns_correct_view()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();

        $response = $this->actingAs($user)->get(route('events.trainers.index', $event));
        $response->assertStatus(302);
        $response->assertRedirect(route('events.show', $event));
    }

    /**
     * Test the event trainer create route.
     *
     * @return void
     */
    public function test_event_trainer_create_route_returns_correct_view()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();

        $response = $this->actingAs($user)->get(route('events.trainers.create', $event));
        $response->assertStatus(200);
        $response->assertViewIs('events.trainers.create', $event);
    }

    /**
     * Test the event trainer show route.
     *
     * @return void
     */
    public function test_event_trainer_show_route_returns_correct_view()
    {

    }

    /**
     * Test the event trainer edit route.
     *
     * @return void
     */
    public function test_event_trainer_edit_route_returns_correct_view()
    {
        
    }

}
