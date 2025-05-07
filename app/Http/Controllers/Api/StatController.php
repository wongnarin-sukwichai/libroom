<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Reserve;
use Carbon\Carbon;

class StatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        function check($code)
        {
            $now = Carbon::now();
            // $now = Carbon::createFromDate('2025-03-01');

            if ($code != 0) {
                $result = $now->subMonths($code);
                return $result;
            } else {
                return $now;
            }
        }

        $data = [];
        $j = 0;
        $k = 2;

        for ($i = 2; $i >= 0; $i--) {

            $data[$j]['month'] = check($k)->format('Y-m') . '-01';
            $data[$j]['a'] = Reserve::whereBetween('date', [check($k)->format('Y-m') . '-01', check($k)->format('Y-m') . '-31'])->where('con_id', '1')->count();
            $data[$j]['b'] = Reserve::whereBetween('date', [check($k)->format('Y-m') . '-01', check($k)->format('Y-m') . '-31'])->where('con_id', '2')->count();
            $data[$j]['c'] = Reserve::whereBetween('date', [check($k)->format('Y-m') . '-01', check($k)->format('Y-m') . '-31'])->where('con_id', '3')->count();
            $data[$j]['pg'] = Reserve::whereBetween('date', [check($k)->format('Y-m') . '-01', check($k)->format('Y-m') . '-31'])->where('con_id', '4')->count();
            $data[$j]['std'] = Reserve::whereBetween('date', [check($k)->format('Y-m') . '-01', check($k)->format('Y-m') . '-31'])->where('con_id', '5')->count();
            $data[$j]['tv'] = Reserve::whereBetween('date', [check($k)->format('Y-m') . '-01', check($k)->format('Y-m') . '-31'])->where('con_id', '6')->count();
            $data[$j]['com'] = Reserve::whereBetween('date', [check($k)->format('Y-m') . '-01', check($k)->format('Y-m') . '-31'])->where('con_id', '7')->count();
            $data[$j]['pav'] = Reserve::whereBetween('date', [check($k)->format('Y-m') . '-01', check($k)->format('Y-m') . '-31'])->where('con_id', '13')->count();
            $data[$j]['nap'] = Reserve::whereBetween('date', [check($k)->format('Y-m') . '-01', check($k)->format('Y-m') . '-31'])->where('con_id', '14')->count();
            $data[$j]['play'] = Reserve::whereBetween('date', [check($k)->format('Y-m') . '-01', check($k)->format('Y-m') . '-31'])->where('con_id', '15')->count();
            $data[$j]['online'] = Reserve::whereBetween('date', [check($k)->format('Y-m') . '-01', check($k)->format('Y-m') . '-31'])->where('con_id', '16')->count();
            $data[$j]['pool'] = Reserve::whereBetween('date', [check($k)->format('Y-m') . '-01', check($k)->format('Y-m') . '-31'])->where('con_id', '17')->count();
            $data[$j]['space1'] = Reserve::whereBetween('date', [check($k)->format('Y-m') . '-01', check($k)->format('Y-m') . '-31'])->where('con_id', '18')->count();
            $data[$j]['space2'] = Reserve::whereBetween('date', [check($k)->format('Y-m') . '-01', check($k)->format('Y-m') . '-31'])->where('con_id', '19')->count();
            $data[$j]['chaira'] = Reserve::whereBetween('date', [check($k)->format('Y-m') . '-01', check($k)->format('Y-m') . '-31'])->where('con_id', '20')->count();
            // $data[$j]['chairc'] = Reserve::whereBetween('date', [check($k)->format('Y-m') . '-01', check($k)->format('Y-m') . '-31'])->where('con_id', '')->count();

            $j++;
            $k--;
        }
        
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
