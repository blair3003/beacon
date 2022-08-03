<?php 

namespace Tests\Feature\Http\Controllers; 

use App\Models\Course;
use App\Models\Event;
use App\Models\Venue;
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
    public function test_courses_index_route_returns_index_view()
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
    public function test_courses_create_route_returns_create_view()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('courses.create'));
        $response->assertStatus(200);
        $response->assertViewIs('courses.create');
    } 

    /**
     * Test the courses show route.
     *
     * @return void
     */
    public function test_courses_show_route_returns_show_view()
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
    public function test_courses_edit_route_returns_edit_view()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        
        $response = $this->actingAs($user)->get(route('courses.edit', $course));
        $response->assertStatus(200);
        $response->assertViewIs('courses.edit', $course);
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
            'title' => $this->faker->catchPhrase(),
            'code' => strtoupper($this->faker->lexify('???')),
            'description' => $this->faker->text(),
            'max_trainees' => 30,
            'cert_period' => 4
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Course created!');
    }

    /**
     * Test the courses store route with non-unique course title.
     *
     * @return void
     */
    public function test_courses_store_route_only_stores_unique_titles()
    {
        $user = User::factory()->create();
        $title = $this->faker->catchPhrase();
        
         Course::create([            
            'title' => $title,
            'code' => strtoupper($this->faker->lexify('???')),
            'max_trainees' => 30,
            'cert_period' => 4
        ]);
        
        $response = $this->actingAs($user)->post(route('courses.store'), [            
            'title' => $title,
            'code' => strtoupper($this->faker->lexify('???')),
            'max_trainees' => 30,
            'cert_period' => 4
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('title');
    }

    /**
     * Test the courses store route with non-unique course codes.
     *
     * @return void
     */
    public function test_courses_store_route_only_stores_unique_codes()
    {
        $user = User::factory()->create();
        $code = strtoupper($this->faker->lexify('???'));
        
        Course::create([            
            'title' => $this->faker->catchPhrase(),
            'code' => $code,
            'max_trainees' => 30,
            'cert_period' => 4
        ]);
        
        $response = $this->actingAs($user)->post(route('courses.store'), [            
            'title' => $this->faker->catchPhrase(),
            'code' => $code,
            'max_trainees' => 30,
            'cert_period' => 4
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('code');
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
            'title' => $this->faker->catchPhrase(),
            'code' => strtoupper($this->faker->lexify('???')),
            'description' => $this->faker->text(),
            'max_trainees' => 30,
            'cert_period' => 4
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Course updated!');
    }

    /**
     * Test the courses update route with non-unique course title.
     *
     * @return void
     */
    public function test_courses_update_route_only_updates_unique_titles()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $title = $this->faker->catchPhrase();
        
        Course::create([            
            'title' => $title,
            'code' => strtoupper($this->faker->lexify('???')),
            'max_trainees' => 30,
            'cert_period' => 4
        ]);
        
        $response = $this->actingAs($user)->put(route('courses.update', $course), [            
            'title' => $title,
            'code' => strtoupper($this->faker->lexify('???')),
            'max_trainees' => 30,
            'cert_period' => 4
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('title');
    }

    /**
     * Test the courses update route with non-unique course codes.
     *
     * @return void
     */
    public function test_courses_update_route_only_updates_unique_codes()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $code = strtoupper($this->faker->lexify('???'));
        
        Course::create([            
            'title' => $this->faker->catchPhrase(),
            'code' => $code,
            'max_trainees' => 30,
            'cert_period' => 4
        ]);
        
        $response = $this->actingAs($user)->put(route('courses.update', $course), [            
            'title' => $this->faker->catchPhrase(),
            'code' => $code,
            'max_trainees' => 30,
            'cert_period' => 4
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('code');
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

    /**
     * Test the courses destroy route with dependent events.
     *
     * @return void
     */
    public function test_courses_destroy_route_only_removes_courses_without_events()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        $event = Event::factory()->create();

        $response = $this->actingAs($user)->delete(route('courses.destroy', $event->course));
        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Course cannot be removed!');
        $this->assertDatabaseHas('courses', [
            'id' => $event->course->id
        ]);
    }     

}
