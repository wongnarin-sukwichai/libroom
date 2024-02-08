<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Location;
use App\Models\Container;

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
}
