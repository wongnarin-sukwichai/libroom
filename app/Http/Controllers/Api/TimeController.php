<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Time;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Time::all();

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'time' => 'required',
            'start' => 'required',
            'end' => 'required'
        ]);

        $data = new Time();
        $data->title = $request['title'];
        $data->time = $request['time'];
        $data->start = $request['start'];
        $data->end = $request['end'];
        $data->created = Auth::user()-> name . ' ' . Auth::user()->surname;

        $data->save();

        return response()->json($data);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Time::find($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $data = Time::find($id);

       $data->title = $request['title'];
       $data->time = $request['time'];
       $data->start = $request['start'];
       $data->end = $request['end'];
       $data->created = Auth::user()-> name . ' ' . Auth::user()->surname;

       $data->update();

       return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Time::find($id)->delete();
        return response()->json();
    }
}
