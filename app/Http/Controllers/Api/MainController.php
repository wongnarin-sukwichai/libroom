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

    public function reserveMain(string $id, string $code)
    {
        $data = Reserve::where('date', $code)
            ->where('con_id', $id)
            ->select('room_id', 'time', 'name', 'surname', 'status')
            ->get();

        return response()->json($data);
    }

    public function reserve(Request $request)
    {

        $request->validate([
            'date' => 'required',
            'loc_id' => 'required',
            'con_id' => 'required',
            'room_id' => 'required',
            'uid' => 'required',
            'time' => 'required',
            'code' => 'required'
        ]);

        if ($request['uid'] != '000') {
            return response()->json([
                'icon' => 'error',
                'title' => 'ผิดพลาด',
                'text' => 'รหัสนิสิตไม่ถูกต้อง กรุณาตรวจสอบ'
            ]);
        } else {

            $name = 'วงศ์นรินทร์';
            $surname = 'สุขวิชัย';

            for ($i = 0; $i < count($request['time']); $i++) {

                $data = new Reserve();

                $data->date = $request['date'];
                $data->loc_id = $request['loc_id'];
                $data->con_id = $request['con_id'];
                $data->room_id = $request['room_id'];
                $data->time = $request['time'][$i];
                $data->uid = $request['uid'];
                $data->name = $name;
                $data->surname = $surname;
                $data->code = $request['code'];
                $data->status = 0;

                $data->save();
            }

            return response()->json([
                'icon' => "success",
                'title' => $request['code'],
                'text' => "** รหัสยกเลิกการจอง **"
            ]);
        }
    }
}
