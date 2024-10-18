<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use App\Models\Reserve;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getService()
    {
        $res = Carbon::now()->format('Y-m-d');

        $data = Reserve::where('date', $res)->where('loc_id', 1)->count();
        $result = Reserve::where('date', $res)->where('loc_id', 2)->count();

        return response()->json([
            'arec' => $data,
            'dlp' => $result
        ]);
    }

    public function getMost()
    {

        $res = Carbon::now()->format('Y-m-d');

        $data = DB::table('Reserves')
            ->where('date', $res)
            ->select('faculty', DB::raw('COUNT(*) AS count'))
            ->groupBy('faculty')
            ->orderByRaw('COUNT(*) DESC')
            ->take(5)
            ->get();

        return response()->json($data);
    }

    public function getAccess(string $room, string $uid)
    {

        if ($uid == '20000000604013') {

            $data = array(
                'room_id' => $room,
                'uid' => 'staff',
                'status' => 1
            );

            return response()->json($data);
        } else {

            $res = Carbon::now()->format('Y-m-d');

            $data = Reserve::where('date', $res)
                ->where('room_id', $room)
                ->where('uid', $uid)
                ->where('status', 1)
                ->select('room_id', 'uid', 'status')
                ->first();

            return response()->json($data);
        }
    }

    public function getPatron(string $id)
    {
        $url = 'https://libapp.msu.ac.th/v1/api/GetPatronDetail/' . $id . '';
        $sToken = 'token';

        $chOne = curl_init();
        curl_setopt($chOne, CURLOPT_URL, '' . $url . '');
        curl_setopt($chOne, CURLOPT_CUSTOMREQUEST, 'GET');
        $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $sToken . '',);
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($chOne);

        //dd($result);

        if (curl_error($chOne)) {
            echo 'error:' . curl_error($chOne);
        } else {
            $res = json_decode($result, true);
            return $res;
        }

        curl_close($chOne);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
