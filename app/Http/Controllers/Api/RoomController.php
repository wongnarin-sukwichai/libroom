<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'pic' => 'required',
            'loc_id' => 'required',
            'con_id' => 'required',
            'title' => 'required',
        ]);

        $data = new Room();
        $data->pic = $request['pic'];
        $data->loc_id = $request['loc_id'];
        $data->con_id = $request['con_id'];
        $data->title = $request['title'];
        $data->status = 0;
        $data->created = Auth::user()->name . ' ' . Auth::user()->surname;

        $data->save();

        return response()->json($data);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Room::where('con_id', $id)->get();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Room::find($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Room::find($id);

        $data->pic = $request['pic'];
        $data->title = $request['title'];
        $data->created = Auth::user()->name . ' ' . Auth::user()->surname;

        $data->update();

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function roomStatus(string $id, string $code)
    {

        $data = Room::find($id);

        $data->status = $code;
        $data->created = Auth::user()->name . ' ' . Auth::user()->surname;

        $data->update();

        return response()->json($data);
    }
}
