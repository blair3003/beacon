<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Trainee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TraineeControllerTest extends TestCase
{
    private function createUser()
    {
        return User::factory()->create();
    }

    private function createTrainee()
    {
        return Trainee::factory()->create();
    }

    /**
     * Test the trainees index route.
     *
     * @return void
     */
    public function test_trainees_index_route_returns_correct_view()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->get(route('trainees.index'));
        $response->assertStatus(200);
        $response->assertViewIs('trainees.index');
    }

    /**
     * Test the trainees create route.
     *
     * @return void
     */
    public function test_trainees_create_route_returns_correct_view()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->get(route('trainees.create'));
        $response->assertStatus(200);
        $response->assertViewIs('trainees.create');
    }

    /**
     * Test the trainees show route.
     *
     * @return void
     */
    public function test_trainees_show_route_returns_correct_view()
    {
        $user = $this->createUser(); 
        $trainee = $this->createTrainee();
        
        $response = $this->actingAs($user)->get(route('trainees.show', $trainee));
        $response->assertStatus(200);
        $response->assertViewIs('trainees.show', $trainee);
    }

    /**
     * Test the trainees edit route.
     *
     * @return void
     */
    public function test_trainees_edit_route_returns_correct_view()
    {
        $user = $this->createUser(); 
        $trainee = $this->createTrainee();
        
        $response = $this->actingAs($user)->get(route('trainees.edit', $trainee));
        $response->assertStatus(200);
        $response->assertViewIs('trainees.edit', $trainee);
    }

}
