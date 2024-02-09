<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Location;
use App\Models\Container;
use App\Models\Room;
use App\Models\Time;

class MainController extends Controller
{
    public function locMain()
    {
        $data = Location::all();

        return response()->json($data);
    }

    public function conMain()
    {
        $data = Container::all();

        return response()->json($data);
    }

    public function roomMain(string $id)
    {
        $data = Room::where('con_id', $id)->get();

        return response()->json($data);
    }

    public function timeMain()
    {
        $data = Time::all();

        return response()->json($data);
    }
}
