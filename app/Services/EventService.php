<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Event;
use App\Models\Trainee;
use App\Models\Trainer;
use App\Models\Venue;

class EventService
{
    public function addTrainee(Event $event, Trainee $trainee)
    {
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

    public function removeTrainee(Event $event, Trainee $trainee)
    {
        if ($event->trainees->doesntContain($trainee)) {            
            throw new \Exception('Trainee not on event!');
        }

        $event->trainees()->detach($trainee);
    }

    public function addTrainer(Event $event, Trainer $trainer)
    {
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

        if ($trainer->trainee->certificates->doesntContain(
            function ($certificate) use ($event) {
                return $certificate->event->course->id == $event->course->id
                    && $certificate->event->end_date
                        ->addYears($certificate->event->course->cert_period)
                        ->gt($event->start_date);
            })) {
            throw new \Exception('Trainer no longer certified!');
        }

        $event->trainers()->attach($trainer);
    }

    public function removeTrainer(Event $event, Trainer $trainer)
    {
        if ($event->trainers->doesntContain($trainer)) {            
            throw new \Exception('Trainer not on event!');
        }

        $event->trainers()->detach($trainer);
    }





}
