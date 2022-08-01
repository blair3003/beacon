<?php

namespace Tests\Feature\Http\Controllers; 

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test the courses index route.
     *
     * @return void
     */
    public function test_courses_index_route_returns_correct_view()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('courses.index'));
        $response->assertStatus(200);
        $response->assertViewIs('courses.index');
    }

    /**
     * Test the courses create route.
     *
     * @return void
     */
    public function test_courses_create_route_returns_correct_view()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('courses.create'));
        $response->assertStatus(200);
        $response->assertViewIs('courses.create');
    }

    /**
     * Test the courses store route.
     *
     * @return void
     */
    public function test_courses_store_route_stores_course()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->post(route('courses.store'), [            
            'title' => $this->faker->unique()->catchPhrase(),
            'code' => strtoupper($this->faker->unique()->lexify('???')),
            'description' => $this->faker->text(),
            'max_trainees' => 30,
            'cert_period' => 4
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Course created!');
    } 

    /**
     * Test the courses show route.
     *
     * @return void
     */
    public function test_courses_show_route_returns_correct_view()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        
        $response = $this->actingAs($user)->get(route('courses.show', $course));
        $response->assertStatus(200);
        $response->assertViewIs('courses.show', $course);
    }

    /**
     * Test the courses edit route.
     *
     * @return void
     */
    public function test_courses_edit_route_returns_correct_view()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        
        $response = $this->actingAs($user)->get(route('courses.edit', $course));
        $response->assertStatus(200);
        $response->assertViewIs('courses.edit', $course);
    }

    /**
     * Test the courses update route.
     *
     * @return void
     */
    public function test_courses_update_route_updates_course()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        
        $response = $this->actingAs($user)->put(route('courses.update', $course), [            
            'title' => $this->faker->unique()->catchPhrase(),
            'code' => strtoupper($this->faker->unique()->lexify('???')),
            'description' => $this->faker->text(),
            'max_trainees' => 30,
            'cert_period' => 4
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Course updated!');
    }

    /**
     * Test the courses destroy route.
     *
     * @return void
     */
    public function test_courses_destroy_route_removes_course()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        
        $response = $this->actingAs($user)->delete(route('courses.destroy', $course));

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Course removed!');
    }  

}
