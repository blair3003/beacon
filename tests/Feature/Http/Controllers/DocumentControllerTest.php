<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Course;
use App\Models\Event;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DocumentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the documents index route.
     *
     * @return void
     */
    public function test_documents_index_route_returns_event_index_view()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('documents.index'));
        $response->assertStatus(302);
        $response->assertRedirect(route('events.index'));
    }

    /**
     * Test the documents create route.
     *
     * @return void
     */
    public function test_documents_create_route_returns_event_index_view()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('documents.create'));
        $response->assertStatus(302);
        $response->assertRedirect(route('events.index'));
    }

}
