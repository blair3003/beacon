<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventTraineeStoreRequest;
use App\Models\Event;
use App\Models\Trainee;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventTraineeController extends Controller
{
    protected $eventService;

    public function __construct(EventService $eventService)
    {
        $this->eventService = $eventService;
    }

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
            'trainees' => Trainee::whereNotIn('id', $event->trainees->pluck('id'))->orderBy('last_name', 'asc')->get()
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
        try {
            $this->eventService->addTrainee($event, Trainee::find($request->trainee_id));
        } catch (\Exception $exception) {
            return back()->with('message', $exception->getMessage());
        }

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
        try {
            $this->eventService->removeTrainee($event, $trainee);
        } catch (\Exception $exception) {
            return redirect(route('events.show', $event))->with('message', $exception->getMessage());
        }
        
        return redirect(route('events.show', $event))->with('message', 'Trainee removed from event!');
    }
}
