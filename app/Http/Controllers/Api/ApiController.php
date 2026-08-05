<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

use App\Models\Reserve;
use App\Models\Time;

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
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d');

        $data = Reserve::whereBetween('date', [$startOfMonth, $endOfMonth])
            ->where('loc_id', 1)
            ->where('status', 1)
            ->count();

        $result = Reserve::whereBetween('date', [$startOfMonth, $endOfMonth])
            ->where('loc_id', 2)
            ->where('status', 1)
            ->count();

        $res = Reserve::whereBetween('date', [$startOfMonth, $endOfMonth])
            ->where('loc_id', 3)
            ->where('status', 1)
            ->count();

        return response()->json([
            'arec' => $data,
            'dlp' => $result,
            'res' => $res
        ]);
    }

    public function getMost()
    {
        // Query ข้อมูล
        $data = DB::table('memberss')
            ->whereNotNull('faculty') // กันค่า faculty ว่าง
            ->select('faculty', DB::raw('COUNT(*) AS count'))
            ->groupBy('faculty')
            ->orderByRaw('COUNT(*) DESC')
            ->take(5)
            ->get();

        return response()->json($data);
    }

    public function getAccess(string $room, string $uid)
    {

        if ($uid == '4013') {

            $data = array(
                'room_id' => $room,
                'uid' => 'staff',
                'status' => 1
            );

            return response()->json($data);
        } else {

            $now = Carbon::now();
            $res = $now->format('Y-m-d');
            $result = $now->format('H');
            $check = $now->isWeekend();                    //check ว่าใช่วัน ส-อ ไหม

            // dd($res, $result, $check);

            if ($check == false) {
                $check = Time::where('id', 1)->first()->hour;
                $time = $result - $check;
            } else {
                $check = Time::where('id', 2)->first()->hour;
                $time = $result - $check;
            }

            $data = Reserve::where('date', $res)
                ->where('room_id', $room)
                ->where('time', $time)
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

    public function getTimeReserve(string $room)
    {
        // อนุญาตเฉพาะห้อง id 49 และ 50 เท่านั้น นอกเหนือจากนี้คืนค่าว่างกลับไป
        if (!in_array($room, ['49', '50'])) {
            return response()->json([]);
        }

        $now = Carbon::now();
        $today = $now->format('Y-m-d');
        $isWeekend = $now->isWeekend();

        // 1. ดึงเงื่อนไขเวลาตามวัน (ธรรมดา / เสาร์-อาทิตย์)
        $timeConfig = Time::find($isWeekend ? 2 : 1);

        $totalSlots = (int) $timeConfig->total; // เช่น 11 หรือ 8
        $startHour = (int) $timeConfig->total;  // เช่น 11 หรือ 8

        // 2. ดึงรายการการจองของห้องและวันที่ระบุ
        // pluck('time') จะได้ array ของ slot ที่ถูกจอง เช่น [1, 2, 7]
        $bookedSlots = Reserve::where('date', $today)
            ->where('room_id', $room)
            ->pluck('time')
            ->toArray();

        // 3. สร้าง Array ของ slots (0 = ว่าง, 1 = ไม่ว่าง)
        // time ในตาราง reserves เริ่มนับที่ 0 จึงต้อง loop เริ่มที่ 0 ให้ index ตรงกับค่า time
        $slots = [];
        for ($i = 0; $i < $totalSlots; $i++) {
            // เช็กว่า slot (ลำดับชั่วโมง) นี้ถูกจองไปแล้วหรือยัง
            $slots[] = in_array($i, $bookedSlots) ? 1 : 0;
        }

        // 4. ส่งผลลัพธ์กลับในรูปแบบ JSON
        return response()->json([
            'room_id'    => $room,
            'date'       => $today,
            'start_hour' => $startHour,
            'start_time' => (float) $timeConfig->start,
            'end_time'   => (float) $timeConfig->end,
            'slots'      => $slots
        ]);
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
