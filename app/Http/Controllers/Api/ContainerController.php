<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Container;
use Mockery\Matcher\Contains;

class ContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Container::all();

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
            'loc_id' => 'required',
            'pic' => 'required',
            'title' => 'required',
            'detail' => 'required'
        ]);

        $data = new Container();
        $data->loc_id = $request['loc_id'];
        $data->pic = $request['pic'];
        $data->title = $request['title'];
        $data->detail = $request['detail'];
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
        $data = Container::find($id);

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Container::find($id);

        $data->loc_id = $request['loc_id'];
        $data->pic = $request['pic'];
        $data->title = $request['title'];
        $data->detail = $request['detail'];
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

    public function conStatus(string $id, string $code)
    {

        $data = Container::find($id);

        $data->status = $code;
        $data->created = Auth::user()->name . ' ' . Auth::user()->surname;

        $data->update();

        return response()->json($data);
    }
}
