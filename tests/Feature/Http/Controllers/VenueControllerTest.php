<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VenueControllerTest extends TestCase
{
    private function createUser()
    {
        return User::factory()->create();
    }

    private function createVenue()
    {
        return Venue::factory()->create();
    }

    /**
     * Test the venues index route.
     *
     * @return void
     */
    public function test_venues_index_route_returns_correct_view()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->get(route('venues.index'));
        $response->assertStatus(200);
        $response->assertViewIs('venues.index');
    }

    /**
     * Test the venues create route.
     *
     * @return void
     */
    public function test_venues_create_route_returns_correct_view()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->get(route('venues.create'));
        $response->assertStatus(200);
        $response->assertViewIs('venues.create');
    }

    /**
     * Test the venues show route.
     *
     * @return void
     */
    public function test_venues_show_route_returns_correct_view()
    {
        $user = $this->createUser(); 
        $venue = $this->createVenue();
        
        $response = $this->actingAs($user)->get(route('venues.show', $venue));
        $response->assertStatus(200);
        $response->assertViewIs('venues.show', $venue);
    }

    /**
     * Test the venues edit route.
     *
     * @return void
     */
    public function test_venues_edit_route_returns_correct_view()
    {
        $user = $this->createUser(); 
        $venue = $this->createVenue();
        
        $response = $this->actingAs($user)->get(route('venues.edit', $venue));
        $response->assertStatus(200);
        $response->assertViewIs('venues.edit', $venue);
    }

}
