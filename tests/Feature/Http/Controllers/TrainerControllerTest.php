<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Trainee;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrainerControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the trainers index route.
     *
     * @return void
     */
    public function test_trainers_index_route_returns_index_view()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('trainers.index'));
        $response->assertStatus(200);
        $response->assertViewIs('trainers.index');
    }

    /**
     * Test the trainers create route.
     *
     * @return void
     */
    public function test_trainers_create_route_returns_create_view()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('trainers.create'));
        $response->assertStatus(200);
        $response->assertViewIs('trainers.create');
    }

    /**
     * Test the trainers show route.
     *
     * @return void
     */
    public function test_trainers_show_route_returns_trainee_show_view()
    {
        $user = User::factory()->create();
        $trainer = Trainer::factory()->create();
        
        $response = $this->actingAs($user)->get(route('trainers.show', $trainer));
        $response->assertStatus(302);
        $response->assertRedirect(route('trainees.show', $trainer->trainee));
    }

    /**
     * Test the trainers edit route.
     *
     * @return void
     */
    public function test_trainers_edit_route_returns_trainee_edit_view()
    {
        $user = User::factory()->create();
        $trainer = Trainer::factory()->create();
        
        $response = $this->actingAs($user)->get(route('trainers.edit', $trainer));
        $response->assertStatus(302);
        $response->assertRedirect(route('trainees.edit', $trainer->trainee));
    }

    /**
     * Test the trainers update route.
     *
     * @return void
     */
    public function test_trainers_update_route_returns_trainee_show_view()
    {
        $user = User::factory()->create();
        $trainer = Trainer::factory()->create();
        $trainee = Trainee::factory()->create();        
        
        $response = $this->actingAs($user)->put(route('trainers.update', $trainer), [
            'trainee_id' => $trainee->id
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('trainees.show', $trainer->trainee));
    }    

    /**
     * Test the trainers store route.
     *
     * @return void
     */
    public function test_trainers_store_route_stores_trainer()
    {
        $user = User::factory()->create();
        $trainee = Trainee::factory()->create();
        
        $response = $this->actingAs($user)->post(route('trainers.store'), [
            'trainee_id' => $trainee->id
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Trainer created!');
    }

    /**
     * Test the trainers store route with non-unique trainee ids.
     *
     * @return void
     */
    public function test_trainers_store_route_only_stores_unique_trainees()
    {
        $user = User::factory()->create();
        $trainee = Trainee::factory()->create();

        Trainer::create([
            'trainee_id' => $trainee->id
        ]);
        
        $response = $this->actingAs($user)->post(route('trainers.store'), [
            'trainee_id' => $trainee->id
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('trainee_id');
    } 

    /**
     * Test the trainers destroy route.
     *
     * @return void
     */
    public function test_trainers_destroy_route_removes_trainer()
    {
        $user = User::factory()->create();
        $trainer = Trainer::factory()->create();
        
        $response = $this->actingAs($user)->delete(route('trainers.destroy', $trainer));
        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Trainer removed!');
    } 

}
