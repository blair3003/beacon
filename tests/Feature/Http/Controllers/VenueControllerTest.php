<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VenueControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test the venues index route.
     *
     * @return void
     */
    public function test_venues_index_route_returns_correct_view()
    {
        $user = User::factory()->create();

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
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('venues.create'));
        $response->assertStatus(200);
        $response->assertViewIs('venues.create');
    }

    /**
     * Test the venues store route.
     *
     * @return void
     */
    public function test_venues_store_route_stores_venue()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->post(route('venues.store'), [
            'name' => $this->faker->unique()->company(),
            'email' => $this->faker->email(),
            'tel' => $this->faker->phoneNumber(),
            'address_1' => $this->faker->buildingNumber(),
            'address_2' => $this->faker->streetName(),
            'address_3' => $this->faker->secondaryAddress(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'zip' => $this->faker->postcode(),
            'notes' => $this->faker->text()
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Venue created!');
    } 

    /**
     * Test the venues show route.
     *
     * @return void
     */
    public function test_venues_show_route_returns_correct_view()
    {
        $user = User::factory()->create();
        $venue = Venue::factory()->create();
        
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
        $user = User::factory()->create();
        $venue = Venue::factory()->create();
        
        $response = $this->actingAs($user)->get(route('venues.edit', $venue));
        $response->assertStatus(200);
        $response->assertViewIs('venues.edit', $venue);
    }

    /**
     * Test the venues update route.
     *
     * @return void
     */
    public function test_venues_update_route_updates_venue()
    {
        $user = User::factory()->create();
        $venue = Venue::factory()->create();
        
        $response = $this->actingAs($user)->put(route('venues.update', $venue), [
            'name' => $this->faker->unique()->company(),
            'email' => $this->faker->email(),
            'tel' => $this->faker->phoneNumber(),
            'address_1' => $this->faker->buildingNumber(),
            'address_2' => $this->faker->streetName(),
            'address_3' => $this->faker->secondaryAddress(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'zip' => $this->faker->postcode(),
            'notes' => $this->faker->text()
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Venue updated!');
    }

    /**
     * Test the venues destroy route.
     *
     * @return void
     */
    public function test_venues_destroy_route_removes_venue()
    {
        $user = User::factory()->create();
        $venue = Venue::factory()->create();
        
        $response = $this->actingAs($user)->delete(route('venues.destroy', $venue));
        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Venue removed!');
    }  

}
