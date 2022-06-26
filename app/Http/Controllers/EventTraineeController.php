<?php

namespace App\Http\Controllers;

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
        dd(request());
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
            'trainees' => Trainee::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Event $event)
    {
        $formFields = $request->validate([
            'trainee_id' => 'required|exists:trainees,id'
        ]);

        $trainee = Trainee::find($request->trainee_id);

        if ($event->trainees->contains($trainee)) {
            return redirect(route('events.trainees.create', $event))->with('message', 'Trainee already on event!');

        }

        $event->trainees()->attach($trainee);

        return redirect('/events/' . $event->id);
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
        dd(request());
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
        dd(request());
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
        dd(request());
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
        dd(request());
    }
}
