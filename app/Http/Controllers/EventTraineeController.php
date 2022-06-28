<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventTraineeStoreRequest;
use App\Models\Event;
use App\Models\Trainee;
use Illuminate\Http\Request;

class EventTraineeController extends Controller
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
        return view('events.trainees.create', [
            'event' => $event,
            'trainees' => Trainee::whereNotIn('id', $event->trainees->pluck('id'))->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function store(EventTraineeStoreRequest $request, Event $event)
    {
        $trainee = Trainee::find($request->trainee_id);

        if ($event->trainees->contains($trainee)) {
            return redirect(route('events.trainees.create', $event))->with('message', 'Trainee already on event!');
        }

        $event->trainees()->attach($trainee);

        return redirect(route('events.show', $event))->with('message', 'Trainee added to event!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @param  \App\Models\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event, Trainee $trainee)
    {
        return redirect(route('events.show', $event));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @param  \App\Models\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event, Trainee $trainee)
    {
        return redirect(route('events.show', $event));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @param  \App\Models\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event, Trainee $trainee)
    {
        return redirect(route('events.show', $event));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @param  \App\Models\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event, Trainee $trainee)
    {
        if ($event->trainees->contains($trainee)) {
            $event->trainees()->detach($trainee);
            return redirect(route('events.show', $event))->with('message', 'Trainee removed from event!');
        }
        return redirect(route('events.show', $event));
    }
}
