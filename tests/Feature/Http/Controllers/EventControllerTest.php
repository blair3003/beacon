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
    private function createUser()
    {
        return User::factory()->create();
    }

    private function createCourse()
    {
        return Course::factory()->create();
    }
    
    private function createVenue()
    {
        return Venue::factory()->create();
    }

    private function createEvent()
    {
        $this->createCourse();
        $this->createVenue();
        return Event::factory()->create();
    }

    /**
     * Test the events index route.
     *
     * @return void
     */
    public function test_events_index_route_returns_correct_view()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->get(route('events.index'));
        $response->assertStatus(200);
        $response->assertViewIs('events.index');
    }

    /**
     * Test the events create route.
     *
     * @return void
     */
    public function test_events_create_route_returns_correct_view()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->get(route('events.create'));
        $response->assertStatus(200);
        $response->assertViewIs('events.create');
    }

    /**
     * Test the events show route.
     *
     * @return void
     */
    public function test_events_show_route_returns_correct_view()
    {
        $user = $this->createUser(); 
        $event = $this->createEvent();
        
        $response = $this->actingAs($user)->get(route('events.show', $event));
        $response->assertStatus(200);
        $response->assertViewIs('events.show');
    }

    /**
     * Test the events edit route.
     *
     * @return void
     */
    public function test_events_edit_route_returns_correct_view()
    {
        $user = $this->createUser(); 
        $event = $this->createEvent();
        
        $response = $this->actingAs($user)->get(route('events.edit', $event));
        $response->assertStatus(200);
        $response->assertViewIs('events.edit');
    }

}
