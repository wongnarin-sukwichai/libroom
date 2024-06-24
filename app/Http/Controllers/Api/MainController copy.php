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

        $request->validate([
            'date' => 'required',
            'loc_id' => 'required',
            'con_id' => 'required',
            'room_id' => 'required',
            'time' => 'required',
            'uid' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'code' => 'required'
        ]);

        dd($request->all());

        $res = Reserve::where('date', $request['date'])->where('uid', $request['uid'])->count();
        $result = Record::where('date', $request['date'])->where('uid', $request['uid'])->count();

        if ($res >= 3 || $result >= 3) {
            return response()->json([
                'icon' => 'error',
                'title' => 'ผิดพลาด',
                'text' => 'ท่านใช้บริการเกิน 3 ครั้ง/วัน กรุณาตรวจสอบ'
            ]);
        } else {

            for ($j = 0; $j < count($request['time']); $j++) {

                $data = new Reserve();

                $data->date = $request['date'];
                $data->loc_id = $request['loc_id'];
                $data->con_id = $request['con_id'];
                $data->room_id = $request['room_id'];
                $data->time = $request['time'][$j];
                $data->uid = $request['uid'];
                $data->name = $request['name'];
                $data->surname = $request['surname'];
                $data->code = $request['code'];
                $data->status = 0;

                $data->save();
            }

            return response()->json([
                'icon' => "success",
                'title' => $request['code'],
                'text' => "** กรุณาจดจำรหัส สำหรับใช้ในการยกเลิกการจอง **"
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
