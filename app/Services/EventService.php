<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Event;
use App\Models\Trainee;
use App\Models\Trainer;
use App\Models\Venue;

class EventService
{
    public function addTrainee($event_id, $trainee_id)
    {
        $event = Event::find($event_id);
        $trainee = Trainee::find($trainee_id);

        if ($event->trainees->contains($trainee)) {
            throw new \Exception('Trainee already on event!');
        }

        if ($event->trainers->contains($trainee->trainer)) {
            throw new \Exception('Trainee already on event as Trainer!');
        }

        if ($event->trainees->count() >= $event->course->max_trainees) {
            throw new \Exception('Trainee capacity limit reached!');
        }

        $event->trainees()->attach($trainee);
    }

    public function removeTrainee($event_id, $trainee_id)
    {
        $event = Event::find($event_id);
        $trainee = Trainee::find($trainee_id);

        if ($event->trainees->doesntContain($trainee)) {            
            throw new \Exception('Trainee not on event!');
        }

        $event->trainees()->detach($trainee);
    }

    public function addTrainer($event_id, $trainer_id)
    {
        $event = Event::find($event_id);
        $trainer = Trainer::find($trainer_id);

        if ($event->trainers->contains($trainer)) {
            throw new \Exception('Trainer already on event!');
        }

        if ($event->trainees->contains($trainer->trainee)) {
            throw new \Exception('Trainer already on event as Trainee!');
        }

        if ($trainer->trainee->certificates->doesntContain(
            function ($certificate) use ($event) {
                return $certificate->event->course->id == $event->course->id;
            })) {
            throw new \Exception('Trainer not certified!');
        }

        $event->trainers()->attach($trainer);
    }

    public function removeTrainer($event_id, $trainer_id)
    {
        $event = Event::find($event_id);
        $trainer = Trainer::find($trainer_id);

        if ($event->trainers->doesntContain($trainer)) {            
            throw new \Exception('Trainer not on event!');
        }

        $event->trainers()->detach($trainer);
    }





}
