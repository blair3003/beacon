<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::resources([
        'certificates' => \App\Http\Controllers\CertificateController::class,
        'courses' => \App\Http\Controllers\CourseController::class,
        'documents' => \App\Http\Controllers\DocumentController::class,
        'events' => \App\Http\Controllers\EventController::class,
        'events.trainees' => \App\Http\Controllers\EventTraineeController::class,
        'events.trainers' => \App\Http\Controllers\EventTrainerController::class,
        'trainees' => \App\Http\Controllers\TraineeController::class,
        'trainers' => \App\Http\Controllers\TrainerController::class,
        'venues' => \App\Http\Controllers\VenueController::class,
    ]);
});

Route::get('/search', function () {
    return view('search.results', [
        'events' => \App\Models\Event::latest()->filter(request(['q']))->get(),
        'trainees' => \App\Models\Trainee::latest()->filter(request(['q']))->get(),
        'trainers' => \App\Models\Trainer::latest()->filter(request(['q']))->get(),
        'venues' => \App\Models\Venue::latest()->filter(request(['q']))->get()
    ]);
})->middleware(['auth'])->name('search');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
