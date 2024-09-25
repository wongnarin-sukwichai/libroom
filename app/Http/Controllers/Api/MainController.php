<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Location;
use App\Models\Container;
use App\Models\Holiday;
use App\Models\Room;
use App\Models\Time;
use App\Models\Reserve;
use App\Models\Record;

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

    public function holidayMain(string $id, string $code, string $next, string $to)
    {

        $res = Holiday::Where('d', $id)->where('m', $code)->first();
        $result = Holiday::Where('d', $next)->where('m', $to)->first();

        if (empty($res)) {
            $res = true;
        } else {
            $res = false;
        }

        if (empty($result)) {
            $result = true;
        } else {
            $result = false;
        }

        return response()->json([
            'res' => $res,
            'result' => $result
        ]);
    }

    public function reserveMain(string $id)
    {
        $data = Reserve::where('date', $id)
            ->select('room_id', 'time', 'name', 'surname', 'status')
            ->get();

        return response()->json($data);
    }

    public function addReserve(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'date' => 'required',
            'loc_id' => 'required',
            'con_id' => 'required',
            'room_id' => 'required',
            'time' => 'required',
            'uid' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'type' => 'required',
            'code' => 'required'
        ]);

        for ($k = 0; $k < count($request['time']); $k++) {

            $chk = Reserve::where('date', $request['date'])
                ->where('loc_id', $request['loc_id'])
                ->where('con_id', $request['con_id'])
                ->where('room_id', $request['room_id'])
                ->where('time', $request['time'][$k])
                ->count();

            if ($chk == 0) {
                $res = true;
            } else {
                $res = false;
            }
        }

        if ($res == true) {

            for ($i = 0; $i < count($request['time']); $i++) {

                    for ($j = 0; $j < count($request['uid']); $j++) {

                        $data = new Reserve();

                        $data->date = $request['date'];
                        $data->loc_id = $request['loc_id'];
                        $data->con_id = $request['con_id'];
                        $data->room_id = $request['room_id'];
                        $data->time = $request['time'][$i];
                        $data->uid = $request['uid'][$j];
                        $data->name = $request['name'][$j];
                        $data->surname = $request['surname'][$j];
                        if (!empty($request['type'][$j])) {
                            $data->type = $request['type'][$j];
                        }
                        if (!empty($request['faculty'][$j])) {
                            $data->faculty = $request['faculty'][$j];
                        }
                        if (!empty($request['branch'][$j])) {
                            $data->branch = $request['branch'][$j];
                        }
                        $data->code = $request['code'];
                        $data->status = 0;

                        $data->save();
                    }         
            }

            return response()->json([
                'icon' => "success",
                'title' => $request['code'],
                'text' => "** กรุณาจดจำรหัส สำหรับใช้ในการยกเลิกการจอง **"
            ]);

        } else {

            return response()->json([
                'icon' => "error",
                'title' => "ผิดพลาด",
                'text' => "** ค้นพบข้อมูลการจองซ้ำ กรุณาตรวจสอบอีกครั้ง **"
            ]);
        }
    }

    public function delReserve(Request $request)
    {
        //  dd($request->all());

        $data = Reserve::where('date', $request['today'])
            ->where('room_id', $request['id'])
            ->where('time', $request['time'])
            ->where('code', $request['code'])
            ->first();

        if (!empty($data)) {

            $res = Reserve::where('date', $request['today'])
                ->where('uid', $data->uid)
                ->where('code', $request['code'])
                ->get();

            if (!empty($res)) {
                foreach ($res as $r) {
                    Reserve::find($r->id)->delete();
                }
            }

            return response()->json([
                'icon' => "success",
                'title' => "ยกเลิกการจอง",
                'text' => "ยกเลิกการจองเรียบร้อย"
            ]);
        } else {
            return response()->json([
                'icon' => "error",
                'title' => "รหัสไม่ถูกต้อง",
                'text' => "กรุณาตรวจสอบ"
            ]);
        }
    }

    // public function delReserve(Request $request)
    // {
    //     //  dd($request->all());

    //     $data = Reserve::where('date', $request['today'])->where('room_id', $request['id'])->where('time', $request['time'])->first();

    //     if ($data->code == $request['code']) {

    //         $data->delete();

    //         return response()->json([
    //             'icon' => "success",
    //             'title' => "ยกเลิกการจอง",
    //             'text' => "ยกเลิกการจองเรียบร้อย"
    //         ]);
    //     } else {
    //         return response()->json([
    //             'icon' => "error",
    //             'title' => "รหัสไม่ถูกต้อง",
    //             'text' => "กรุณาตรวจสอบ"
    //         ]);
    //     }
    // }
}
