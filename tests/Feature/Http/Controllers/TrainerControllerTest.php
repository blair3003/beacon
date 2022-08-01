<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Trainer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrainerControllerTest extends TestCase
{
    private function createUser()
    {
        return User::factory()->create();
    }

    private function createTrainer()
    {
        return Trainer::factory()->create();
    }

    /**
     * Test the trainers index route.
     *
     * @return void
     */
    public function test_trainers_index_route_returns_correct_view()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->get(route('trainers.index'));
        $response->assertStatus(200);
        $response->assertViewIs('trainers.index');
    }

    /**
     * Test the trainers create route.
     *
     * @return void
     */
    public function test_trainers_create_route_returns_correct_view()
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->get(route('trainers.create'));
        $response->assertStatus(200);
        $response->assertViewIs('trainers.create');
    }

    /**
     * Test the trainers show route.
     *
     * @return void
     */
    public function test_trainers_show_route_returns_correct_view()
    {
        $user = $this->createUser(); 
        $trainer = $this->createTrainer();
        
        $response = $this->actingAs($user)->get(route('trainers.show', $trainer));
        $response->assertStatus(302);
        $response->assertRedirect(route('trainees.show', $trainer->trainee));
    }

    /**
     * Test the trainers edit route.
     *
     * @return void
     */
    public function test_trainers_edit_route_returns_correct_view()
    {
        $user = $this->createUser(); 
        $trainer = $this->createTrainer();
        
        $response = $this->actingAs($user)->get(route('trainers.edit', $trainer));
        $response->assertStatus(302);
        $response->assertRedirect(route('trainees.edit', $trainer->trainee));
    }

}
