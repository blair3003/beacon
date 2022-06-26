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
        'courses' => \App\Http\Controllers\CourseController::class,
        'events' => \App\Http\Controllers\EventController::class,
        'events.trainees' => \App\Http\Controllers\EventTraineeController::class,
        'events.trainers' => \App\Http\Controllers\EventTrainerController::class,
        'trainees' => \App\Http\Controllers\TraineeController::class,
        'trainers' => \App\Http\Controllers\TrainerController::class,
        'venues' => \App\Http\Controllers\VenueController::class,
    ]);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
