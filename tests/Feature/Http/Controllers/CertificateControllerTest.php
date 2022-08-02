<?php

namespace Tests\Feature\Http\Controllers; 

use App\Models\Certificate;
use App\Models\Course;
use App\Models\Event;
use App\Models\Trainee;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CertificateControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test the certificate index route.
     *
     * @return void
     */
    public function test_certificate_index_route_returns_event_index_view()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('certificates.index'));
        $response->assertStatus(302);
        $response->assertRedirect(route('events.index'));
    }

    /**
     * Test the certificates create route.
     *
     * @return void
     */
    public function test_certificates_create_route_returns_event_index_view()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('certificates.create'));
        $response->assertStatus(302);
        $response->assertRedirect(route('events.index'));
    }
    
    /**
     * Test the certificate show route.
     *
     * @return void
     */
    public function test_certificate_show_route_returns_event_show_view()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();
        $trainee = Trainee::factory()->create();
        $certificate = Certificate::create([
            'event_id' => $event->id,
            'trainee_id' => $trainee->id
        ]);

        $response = $this->actingAs($user)->get(route('certificates.show', $certificate));
        $response->assertStatus(302);
        $response->assertRedirect(route('events.show', $certificate->event));
    }

    /**
     * Test the certificates edit route.
     *
     * @return void
     */
    public function test_certificates_edit_route_returns_event_show_view()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();
        $trainee = Trainee::factory()->create();
        $certificate = Certificate::create([
            'event_id' => $event->id,
            'trainee_id' => $trainee->id
        ]);

        $response = $this->actingAs($user)->get(route('certificates.edit', $certificate));
        $response->assertStatus(302);
        $response->assertRedirect(route('events.show', $certificate->event));
    }

    /**
     * Test the certificates update route.
     *
     * @return void
     */
    public function test_certificates_update_route_returns_event_show_view()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();
        $trainee = Trainee::factory()->create();
        $certificate = Certificate::create([
            'event_id' => $event->id,
            'trainee_id' => $trainee->id
        ]);

        $response = $this->actingAs($user)->put(route('certificates.update', $certificate), [
            'event_id' => $event->id,
            'trainee_id' => $trainee->id
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('events.show', $certificate->event));
    }

    /**
     * Test the certificates store route.
     *
     * @return void
     */
    public function test_certificates_store_route_stores_certificate()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();
        $trainee = Trainee::factory()->create();
        
        $response = $this->actingAs($user)->post(route('certificates.store'), [
            'event_id' => $event->id,
            'trainee_id' => $trainee->id
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Certificate awarded!');
    } 

    /**
     * Test the certificates destroy route.
     *
     * @return void
     */
    public function test_certificates_destroy_route_removes_certificate()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();
        $trainee = Trainee::factory()->create();
        $certificate = Certificate::create([
            'event_id' => $event->id,
            'trainee_id' => $trainee->id
        ]);
        
        $response = $this->actingAs($user)->delete(route('certificates.destroy', $certificate));
        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Certificate removed!');
    }

}
