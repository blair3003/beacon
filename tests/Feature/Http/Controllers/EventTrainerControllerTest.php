<?php 

namespace Tests\Feature\Http\Controllers;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\Event;
use App\Models\Trainee;
use App\Models\Trainer;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTrainerControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test the event trainer create route.
     *
     * @return void
     */
    public function test_event_trainer_create_route_returns_create_view()
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
     * Test the event trainer store route.
     *
     * @return void
     */
    public function test_event_trainer_store_route_stores_event_trainer()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event1 = Event::factory()->create();
        $event2 = Event::factory()->create();
        $trainer = Trainer::factory()->create();

        $event1->trainees()->attach($trainer->trainee);

        Certificate::create([
            'event_id' => $event1->id,
            'trainee_id' => $trainer->trainee->id
        ]);

        $response = $this->actingAs($user)->post(route('events.trainers.store', $event2), [
            'trainer_id' => $trainer->id
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Trainer added to event!');

    }

    /**
     * Test the event trainer store route with non-unique trainers.
     *
     * @return void
     */
    public function test_event_trainer_store_route_only_stores_unique_trainers()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();
        $trainer = Trainer::factory()->create();

        $event->trainers()->attach($trainer);

        $response = $this->actingAs($user)->post(route('events.trainers.store', $event), [
            'trainer_id' => $trainer->id
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Trainer already on event!');
    }

    /**
     * Test the event trainer store route with trainers already attached as trainees.
     *
     * @return void
     */
    public function test_event_trainer_store_route_only_stores_trainers_not_already_trainees()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();
        $trainee = Trainee::factory()->create();
        $trainer = Trainer::create([
            'trainee_id' => $trainee->id
        ]);

        $event->trainees()->attach($trainee);

        $response = $this->actingAs($user)->post(route('events.trainers.store', $event), [
            'trainer_id' => $trainer->id
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Trainer already on event as Trainee!');
    }

    /**
     * Test the event trainer store route with trainers without certification.
     *
     * @return void
     */
    public function test_event_trainer_store_route_only_stores_trainers_with_certification()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();
        $trainer = Trainer::factory()->create();

        $response = $this->actingAs($user)->post(route('events.trainers.store', $event), [
            'trainer_id' => $trainer->id
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Trainer not certified!');
    }

    /**
     * Test the event trainer store route with trainers with expired certificate.
     *
     * @return void
     */
    public function test_event_trainer_store_route_only_stores_fully_certified_trainers()
    {
        $user = User::factory()->create();
        Course::create([
            'title' => $this->faker->unique()->catchPhrase(),
            'code' => strtoupper($this->faker->unique()->lexify('???')),
            'max_trainees' => 30,
            'cert_period' => -10000
        ]);
        Venue::factory()->create();
        $event1 = Event::factory()->create();
        $event2 = Event::factory()->create();
        $trainer = Trainer::factory()->create();

        $event1->trainees()->attach($trainer->trainee);

        Certificate::create([
            'event_id' => $event1->id,
            'trainee_id' => $trainer->trainee->id
        ]);

        $response = $this->actingAs($user)->post(route('events.trainers.store', $event2), [
            'trainer_id' => $trainer->id
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Trainer no longer certified!');
    }

    /**
     * Test the event trainer destroy route.
     *
     * @return void
     */
    public function test_event_trainer_destroy_route_removes_event_trainer()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();
        $trainer = Trainer::factory()->create();

        $event->trainers()->attach($trainer);
        
        $response = $this->actingAs($user)->delete(route('events.trainers.destroy', [$event, $trainer]));

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Trainer removed from event!');
    }

    /**
     * Test the event trainer destroy route with trainer not on event.
     *
     * @return void
     */
    public function test_event_trainer_destroy_route_does_not_remove_event_trainer_not_on_event()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();
        $trainer = Trainer::factory()->create();
        
        $response = $this->actingAs($user)->delete(route('events.trainers.destroy', [$event, $trainer]));

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Trainer not on event!');
    }

}
