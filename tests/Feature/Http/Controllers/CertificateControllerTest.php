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
