<?php

namespace App\Http\Controllers;

use App\Http\Requests\TraineeStoreRequest;
use App\Http\Requests\TraineeUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Trainee;

class TraineeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trainees.index', [
            'trainees' => Trainee::orderBy('last_name', 'asc')->orderBy('first_name', 'asc')->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trainees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TraineeStoreRequest $request)
    {
        $trainee = Trainee::create($request->validated());

        return redirect(route('trainees.show', $trainee))->with('message', 'Trainee created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function show(Trainee $trainee)
    {
        return view('trainees.show', [
            'trainee' => $trainee->load([
                'events' => function ($query) {
                    $query->orderBy('start_date', 'desc');
                },
                'trainer.events' => function ($query) {
                    $query->orderBy('start_date', 'desc');                    
                }
            ])
        ]);


        return view('venues.show', [
            'venue' => $venue->load(['events' => function ($query) {
                $query->orderBy('start_date', 'desc');
            }])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainee $trainee)
    {
        return view('trainees.edit', [
            'trainee' => $trainee
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function update(TraineeUpdateRequest $request, Trainee $trainee)
    {
        $trainee->update($request->validated());

        return redirect(route('trainees.show', $trainee))->with('message', 'Trainee updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trainee  $trainee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trainee $trainee)
    {
        $trainee->delete();

        return redirect(route('trainees.index'))->with('message', 'Trainee removed!');
    }
}
