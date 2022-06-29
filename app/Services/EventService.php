<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Event;
use App\Models\Trainee;
use App\Models\Trainer;
use App\Models\Venue;

class EventService
{
    public function addTrainee($event, $trainee_id)
    {
        $trainee = Trainee::find($trainee_id);

        if ($event->trainees->contains($trainee)) {
            throw new \Exception('Trainee already on event!');
        }        

        if (true) {
            throw new \Exception('Trainee too ugly for course');
        }

        $event->trainees()->attach($trainee);
    }

    public function removeTrainee($event, $trainee)
    {
        if ($event->trainees->doesntContain($trainee)) {            
            throw new \Exception('Trainee not on event!');
        }

        $event->trainees()->detach($trainee);
    }





}
