<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainerStoreRequest;
use Illuminate\Http\Request;
use App\Models\Trainee;
use App\Models\Trainer;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trainers.index', [
            'trainers' => Trainer::join('trainees', 'trainers.trainee_id', '=', 'trainees.id')->orderBy('trainees.last_name')->orderBy('trainees.first_name')->paginate(15)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trainers.create', [
            'trainees' => Trainee::doesntHave('trainer')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrainerStoreRequest $request)
    {
        $trainer = Trainer::create($request->validated());

        return redirect(route('trainees.show', $trainer->trainee))->with('message', 'Trainer created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function show(Trainer $trainer)
    {
        return redirect(route('trainees.show', $trainer->trainee));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainer $trainer)
    {
        return redirect(route('trainees.edit', $trainer->trainee));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trainer $trainer)
    {
        return redirect(route('trainees.show', $trainer->trainee));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trainer $trainer)
    {
        $trainer->delete();

        return redirect(route('trainees.show', $trainer->trainee))->with('message', 'Trainer removed!');
    }
}
 