<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Record;
use Illuminate\Http\Request;

use App\Models\Reserve;

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd('666');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Reserve::where('date', $id)->get();

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, string $code)
    {
        // dd('666');
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {

    //     if ($request['status'] == 0) {
    //         $result = 1;
    //     } else {
    //         $result = 0;
    //     }

    //     $data = Reserve::find($id);

    //     $data->status = $result;

    //     $data->update();

    //     sleep(1);

    //     if ($request['status'] == 0) {

    //         $res = new Record();
    //         $res->date = $data->date;
    //         $res->res_id = $data->id;
    //         $res->uid = $data->uid;
    //         $res->name = $data->name;
    //         $res->surname = $data->surname;

    //         $res->save();
    //     }

    //     return response()->json($data);
    // }

    public function update(Request $request, string $id)
    {

        if ($request['status'] == 0) {
            $result = 1;
        } else {
            $result = 0;
        }

        $data = Reserve::find($id);

        $res = Reserve::where('date', $data->date)
            ->where('uid', $data->uid)
            ->where('code', $data->code)
            ->get();

        foreach ($res as $r) {
            $data = Reserve::find($r->id);
            $data->status = $result;
            $data->update();
        }


        sleep(1);

        if ($request['status'] == 0) {

            $res = new Record();
            $res->date = $data->date;
            $res->res_id = $data->id;
            $res->uid = $data->uid;
            $res->name = $data->name;
            $res->surname = $data->surname;

            $res->save();
        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteReserve(Request $request)
    {

        $data = Reserve::where('date', $request['today'])
            ->where('room_id', $request['room_id'])
            ->where('time', $request['time'])
            ->first()->code;

        $res = Reserve::where('date', $request['today'])
            ->where('code', $data)
            ->get();

        foreach ($res as $r) {
            Reserve::find($r->id)->delete();
        }

        return response()->json([
            'icon' => "success",
            'title' => "ยกเลิกการจอง",
            'text' => "ยกเลิกการจองเรียบร้อย"
        ]);
    }
}
