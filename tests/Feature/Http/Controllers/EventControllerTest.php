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

}
