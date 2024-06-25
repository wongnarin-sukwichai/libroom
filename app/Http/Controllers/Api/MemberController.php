<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Member;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //dd($request['BARCODE']);

        $res = Member::where('uid', $request[0]['BARCODE'])->first();

        if(empty($res)) {
            $data = new Member();

            $data->uid = $request[0]['BARCODE'];
            $data->name = $request[0]['FNAMETHAI'];
            $data->surname = $request[0]['LNAMETHAI'];
    
            $data->save();
        }

        return response()->json($data);
        // return response()->json([
        //     'message' => 'บันทึกข้อมูลเรียบร้อย'
        // ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $data = Member::where('uid', $id)->first();

        if(empty($data)) {
            return response()->json('false');
        } else {
            return response()->json($data);
        }
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
