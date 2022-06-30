<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\Event;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTest extends TestCase
{
    private function createAuthUser()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
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
        $this->createAuthUser();

        $response = $this->get(route('events.index'));

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
        $this->createAuthUser();
        
        $response = $this->get(route('events.create'));

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
        $this->createAuthUser();
        $event = $this->createEvent();
        
        $response = $this->get(route('events.show', $event));

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
        $this->createAuthUser();
        $event = $this->createEvent();
        
        $response = $this->get(route('events.edit', $event));

        $response->assertStatus(200);
        $response->assertViewIs('events.edit');
    }
}
