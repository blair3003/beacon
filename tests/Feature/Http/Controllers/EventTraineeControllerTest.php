<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Course;
use App\Models\Event;
use App\Models\Trainee;
use App\Models\Trainer;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTraineeControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker; 

    /**
     * Test the event trainee create route.
     *
     * @return void
     */
    public function test_event_trainee_create_route_returns_create_view()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();

        $response = $this->actingAs($user)->get(route('events.trainees.create', $event));
        $response->assertStatus(200);
        $response->assertViewIs('events.trainees.create', $event);
    }

    /**
     * Test the event trainee store route.
     *
     * @return void
     */
    public function test_event_trainee_store_route_stores_event_trainee()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();
        $trainee = Trainee::factory()->create();

        $response = $this->actingAs($user)->post(route('events.trainees.store', $event), [
            'trainee_id' => $trainee->id
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Trainee added to event!');

    }

    /**
     * Test the event trainee store route with non-unique trainees.
     *
     * @return void
     */
    public function test_event_trainee_store_route_only_stores_unique_trainees()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();
        $trainee = Trainee::factory()->create();

        $event->trainees()->attach($trainee);

        $response = $this->actingAs($user)->post(route('events.trainees.store', $event), [
            'trainee_id' => $trainee->id
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Trainee already on event!');
    }

    /**
     * Test the event trainee store route with trainees already attached as trainers.
     *
     * @return void
     */
    public function test_event_trainee_store_route_only_stores_trainees_not_already_trainers()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();
        $trainee = Trainee::factory()->create();
        $trainer = Trainer::create([
            'trainee_id' => $trainee->id
        ]);

        $event->trainers()->attach($trainer);

        $response = $this->actingAs($user)->post(route('events.trainees.store', $event), [
            'trainee_id' => $trainee->id
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Trainee already on event as Trainer!');
    }

    /**
     * Test the event trainee store route with more trainees than allowed.
     *
     * @return void
     */
    public function test_event_trainee_store_route_only_stores_trainees_within_course_limit()
    {
        $user = User::factory()->create();
        $course = Course::create([            
            'title' => $this->faker->catchPhrase(),
            'code' => strtoupper($this->faker->lexify('???')),
            'description' => $this->faker->text(),
            'max_trainees' => 1,
            'cert_period' => 4
        ]);
        Venue::factory()->create();
        $event = Event::factory()->create();

        $trainee1 = Trainee::factory()->create();
        $trainee2 = Trainee::factory()->create();

        $event->trainees()->attach($trainee1);

        $response = $this->actingAs($user)->post(route('events.trainees.store', $event), [
            'trainee_id' => $trainee2->id
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Trainee capacity limit reached!');
    }

    /**
     * Test the event trainee destroy route.
     *
     * @return void
     */
    public function test_event_trainee_destroy_route_removes_event_trainee()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();
        $trainee = Trainee::factory()->create();

        $event->trainees()->attach($trainee);
        
        $response = $this->actingAs($user)->delete(route('events.trainees.destroy', [$event, $trainee]));

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Trainee removed from event!');
    }

    /**
     * Test the event trainee destroy route with trainee not on event.
     *
     * @return void
     */
    public function test_event_trainee_destroy_route_does_not_remove_event_trainee_not_on_event()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();
        $trainee = Trainee::factory()->create();
        
        $response = $this->actingAs($user)->delete(route('events.trainees.destroy', [$event, $trainee]));

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Trainee not on event!');
    }

}
