<?php

namespace App\Http\Controllers;

use App\Models\Exercises;
use Illuminate\Http\Request;

class ExercisesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('Exercises::all()');
        $exercises = Exercises::orderBy('id', 'desc')->paginate(15);
        // dd($exercises);
        // $categories = $categories->paginate(15);
        return view('exercises.index', compact('exercises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $exercises = Exercises::orderBy('id', 'desc')->paginate(15);
        // dd($exercises);
        // $categories = $categories->paginate(15);
        return view('exercises.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $input = $request->all();
        if (!request()->filled('active')) {

            $input['exercise_start_date'] = date('Y-m-d H:m:s');
            $input['exercise_end_date'] = date('Y-m-d H:m:s');
            $input['user_id'] = auth()->user()->id;

        }
        $exercise=Exercises::create($input);
        if ($exercise) {
            return redirect()->route('exercises.index');
        } else {
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exercises  $exercises
     * @return \Illuminate\Http\Response
     */
    public function show(Exercises $exercises)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exercises  $exercises
     * @return \Illuminate\Http\Response
     */
    public function edit(Exercises $exercises)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exercises  $exercises
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exercises $exercises)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercises  $exercises
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercises $exercises)
    {
        //
    }
}
