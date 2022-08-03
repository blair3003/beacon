<?php 

namespace Tests\Feature\Http\Controllers;

use App\Models\Course;
use App\Models\Document;
use App\Models\Event;
use App\Models\Trainee;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DocumentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the documents store route for events.
     *
     * @return void
     */
    public function test_documents_store_route_stores_document_for_event()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        Storage::fake('public');
        $event = Event::factory()->create();
        $file = UploadedFile::fake()->create('document.pdf');
        
        $response = $this->actingAs($user)->post(route('documents.store'), [
            'document' => $file,
            'documentable_type' => 'App\Models\Event',
            'documentable_id' => $event->id
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Document added!');
        Storage::disk('public')->assertExists('documents/' . $file->hashName());
    }

    /**
     * Test the documents store route for trainees.
     *
     * @return void
     */
    public function test_documents_store_route_stores_document_for_trainee()
    {
        $user = User::factory()->create();
        $trainee = Trainee::factory()->create();
        Storage::fake('public');        
        $file = UploadedFile::fake()->create('document.pdf');
        
        $response = $this->actingAs($user)->post(route('documents.store'), [
            'document' => $file,
            'documentable_type' => 'App\Models\Trainee',
            'documentable_id' => $trainee->id
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Document added!');
        Storage::disk('public')->assertExists('documents/' . $file->hashName());
    }

    /**
     * Test the documents store route with non-unique file names.
     *
     * @return void
     */
    public function test_documents_store_route_only_stores_unique_document_titles()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        Storage::fake('public');
        $event = Event::factory()->create();
        $file = UploadedFile::fake()->create('document.pdf');
        
        Document::create([
            'title' => $file->getClientOriginalName(),
            'path' => $file->store('documents', 'public'),
            'documentable_type' => 'App\Models\Event',
            'documentable_id' => $event->id
        ]);
        
        $response = $this->actingAs($user)->post(route('documents.store'), [
            'document' => $file,
            'documentable_type' => 'App\Models\Event',
            'documentable_id' => $event->id
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Document exists!');
        Storage::disk('public')->assertExists('documents/' . $file->hashName());
    }

    /**
     * Test the documents destroy route.
     *
     * @return void
     */
    public function test_documents_destroy_route_removes_document()
    {
        $user = User::factory()->create();
        Course::factory()->create();
        Venue::factory()->create();
        Storage::fake('public');
        $event = Event::factory()->create();
        $file = UploadedFile::fake()->create('document.pdf');
        
        $document = Document::create([
            'title' => $file->getClientOriginalName(),
            'path' => $file->store('documents', 'public'),
            'documentable_type' => 'App\Models\Event',
            'documentable_id' => $event->id
        ]);
        
        $response = $this->actingAs($user)->delete(route('documents.destroy', $document));

        $response->assertStatus(302);
        $response->assertSessionHas('message', 'Document removed!');
        Storage::disk('public')->assertMissing('documents/' . $file->hashName());
    }



}
