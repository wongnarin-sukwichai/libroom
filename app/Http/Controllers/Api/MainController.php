<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Location;
use App\Models\Container;
use App\Models\Room;
use App\Models\Time;
use App\Models\Reserve;

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

    public function reserve(Request $request)
    {
        dd($request->all(), count($request['time']));

        $request->validate([
            'day' => 'required',
            'd' => 'required',
            'm' => 'required',
            'y' => 'required',
            'uid' => 'required',
            'time' => 'required',
            'capcha' => 'required'
        ]);

        $name = 'วงศ์นรินทร์';
        $surname = 'สุขวิชัย';

        $data = new Reserve();

        for ($i = 0; $i < count($request['time']); $i++) {

            $data->date = $request['date'];
            $data->loc_id = $request['loc_id'];
            $data->con_id = $request['con_id'];
            $data->room_id = $request['room_id'];
            $data->time = $request['time'][$i];
            $data->uid = $request['uid'];
            $data->name = $name;
            $data->surname = $surname;
            $data->capcha = $request['capcha'];
            $data->status = 0;

            $data->save();
        }

        return response()->json();
    }
}
