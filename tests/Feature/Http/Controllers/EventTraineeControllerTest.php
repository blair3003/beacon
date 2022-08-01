<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Course;
use App\Models\Event;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTraineeControllerTest extends TestCase
{
    private function createUser()
    {
        return User::factory()->create();
    }

    private function createCourse()
    {
        return Course::factory()->create();
    }

    private function createEvent()
    {
        $this->createCourse();
        return Event::factory()->create();
    }

    /**
     * Test the event trainee index route.
     *
     * @return void
     */
    public function test_event_trainee_index_route_returns_correct_view()
    {
        $user = $this->createUser();
        $event = $this->createEvent();

        $response = $this->actingAs($user)->get(route('events.trainees.index', $event));
        $response->assertStatus(302);
        $response->assertRedirect(route('events.show', $event));
    }

    /**
     * Test the event trainee create route.
     *
     * @return void
     */
    public function test_event_trainee_create_route_returns_correct_view()
    {
        $user = $this->createUser();
        $event = $this->createEvent();

        $response = $this->actingAs($user)->get(route('events.trainees.create', $event));
        $response->assertStatus(200);
        $response->assertViewIs('events.trainees.create', $event);
    }

    /**
     * Test the event trainee show route.
     *
     * @return void
     */
    public function test_event_trainee_show_route_returns_correct_view()
    {

    }

    /**
     * Test the event trainee edit route.
     *
     * @return void
     */
    public function test_event_trainee_edit_route_returns_correct_view()
    {

    }

}
