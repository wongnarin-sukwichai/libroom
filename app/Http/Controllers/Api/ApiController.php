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
        $data = Reserve::where('loc_id', 1)->count();
        $res = Reserve::where('loc_id', 2)->count();

        return response()->json([
            'arec' => $data,
            'dlp' => $res
        ]);
    }

    public function getMost()
    {

        $data = DB::table('Reserves')
        ->select('faculty', DB::raw('COUNT(*) AS count'))
        ->groupBy('faculty')
        ->orderByRaw('COUNT(*) DESC')
        ->take(5)
        ->get();

        return response()->json($data);
    }

    public function getAccess(string $id) {

        $res = Carbon::now()->format('Y-m-d');

        $data = Reserve::where('date', $res)
        ->where('uid', $id)
        ->where('status', 1)
        ->select('date', 'loc_id', 'con_id', 'room_id', 'time', 'uid', 'status')
        ->get();

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
