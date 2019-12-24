<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\SystemParameters;

class SystemParametersController extends Controller
{
    //
    function index(Request $request)
    {
        $params = SystemParameters::all()->first();
        return response()->json($params);
    }
}
