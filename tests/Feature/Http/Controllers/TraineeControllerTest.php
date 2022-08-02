<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Trainee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TraineeControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test the trainees index route.
     *
     * @return void
     */
    public function test_trainees_index_route_returns_index_view()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('trainees.index'));
        $response->assertStatus(200);
        $response->assertViewIs('trainees.index');
    }

    /**
     * Test the trainees create route.
     *
     * @return void
     */
    public function test_trainees_create_route_returns_create_view()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('trainees.create'));
        $response->assertStatus(200);
        $response->assertViewIs('trainees.create');
    }

    /**
     * Test the trainees show route.
     *
     * @return void
     */
    public function test_trainees_show_route_returns_show_view()
    {
        $user = User::factory()->create();
        $trainee = Trainee::factory()->create();
        
        $response = $this->actingAs($user)->get(route('trainees.show', $trainee));
        $response->assertStatus(200);
        $response->assertViewIs('trainees.show', $trainee);
    }

    /**
     * Test the trainees edit route.
     *
     * @return void
     */
    public function test_trainees_edit_route_returns_edit_view()
    {
        $user = User::factory()->create();
        $trainee = Trainee::factory()->create();
        
        $response = $this->actingAs($user)->get(route('trainees.edit', $trainee));
        $response->assertStatus(200);
        $response->assertViewIs('trainees.edit', $trainee);
    }

    /**
     * Test the trainees store route.
     *
     * @return void
     */
    public function test_trainees_store_route_stores_trainee()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->post(route('trainees.store'), [
            'title' => $this->faker->title(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'job' => $this->faker->jobTitle(),
            'email' => $this->faker->email(),
            'mobile' => $this->faker->e164PhoneNumber(),
            'tel' => $this->faker->phoneNumber(),
            'address_1' => $this->faker->buildingNumber(),
            'address_2' => $this->faker->streetName(),
            'address_3' => $this->faker->secondaryAddress(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'zip' => $this->faker->postcode()
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Trainee created!');
    }

    /**
     * Test the trainees store route with non-unique trainee email.
     *
     * @return void
     */
    public function test_trainees_store_route_only_stores_unique_emails()
    {
        $user = User::factory()->create();
        $email = $this->faker->email();

        Trainee::create([
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $email
        ]);
        
        $response = $this->actingAs($user)->post(route('trainees.store'), [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $email
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    } 

    /**
     * Test the trainees update route.
     *
     * @return void
     */
    public function test_trainees_update_route_updates_trainee()
    {
        $user = User::factory()->create();
        $trainee = Trainee::factory()->create();
        
        $response = $this->actingAs($user)->put(route('trainees.update', $trainee), [
            'title' => $this->faker->title(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'job' => $this->faker->jobTitle(),
            'email' => $this->faker->email(),
            'mobile' => $this->faker->e164PhoneNumber(),
            'tel' => $this->faker->phoneNumber(),
            'address_1' => $this->faker->buildingNumber(),
            'address_2' => $this->faker->streetName(),
            'address_3' => $this->faker->secondaryAddress(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'zip' => $this->faker->postcode()
        ]);
        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Trainee updated!');
    }

    /**
     * Test the trainees update route with non-unique trainee email.
     *
     * @return void
     */
    public function test_trainees_update_route_only_updates_unique_emails()
    {
        $user = User::factory()->create();
        $trainee = Trainee::factory()->create();
        $email = $this->faker->email();

        Trainee::create([
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $email
        ]);
        
        $response = $this->actingAs($user)->put(route('trainees.update', $trainee), [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $email
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    } 

    /**
     * Test the trainees destroy route.
     *
     * @return void
     */
    public function test_trainees_destroy_route_removes_trainee()
    {
        $user = User::factory()->create();
        $trainee = Trainee::factory()->create();
        
        $response = $this->actingAs($user)->delete(route('trainees.destroy', $trainee));
        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Trainee removed!');
    } 

}
