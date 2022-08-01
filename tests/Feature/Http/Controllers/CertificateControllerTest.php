<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Course;
use App\Models\Event;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CertificateControllerTest extends TestCase
{
    private function createUser()
    {
        return User::factory()->create();
    }

    /**
     * Test the certificate index route.
     *
     * @return void
     */
    public function test_certificate_index_route_returns_correct_view()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->get(route('certificates.index'));
        $response->assertStatus(302);
        $response->assertRedirect(route('events.index'));
    }

    /**
     * Test the certificates create route.
     *
     * @return void
     */
    public function test_certificates_create_route_returns_correct_view()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->get(route('certificates.create'));
        $response->assertStatus(302);
        $response->assertRedirect(route('events.index'));
    }

}
