<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventTrainerStoreRequest;
use App\Models\Event;
use App\Models\Trainer;
use Illuminate\Http\Request;

class EventTrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        return redirect(route('events.show', $event));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        return view('events.trainers.create', [
            'event' => $event,
            'trainers' => Trainer::whereNotIn('id', $event->trainers->pluck('id'))->with('trainee')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function store(EventTrainerStoreRequest $request, Event $event)
    {
        $trainer = Trainer::find($request->trainer_id);

        if ($event->trainers->contains($trainer)) {
            return redirect(route('events.trainers.create', $event))->with('message', 'Trainer already on event!');
        }

        $event->trainers()->attach($trainer);

        return redirect(route('events.show', $event))->with('message', 'Trainer added to event!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event, Trainer $trainer)
    {
        return redirect(route('events.show', $event));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event, Trainer $trainer)
    {
        return redirect(route('events.show', $event));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event, Trainer $trainer)
    {
        return redirect(route('events.show', $event));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event, Trainer $trainer)
    {
        if ($event->trainers->contains($trainer)) {
            $event->trainers()->detach($trainer);
            return redirect(route('events.show', $event))->with('message', 'Trainer removed from event!');
        }
        return redirect(route('events.show', $event));
    }
}
