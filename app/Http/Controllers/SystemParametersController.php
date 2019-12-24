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

    function update(Request $request)
    {

        SystemParameters::where('id', 1)->update([
            'menu_bg_color' => $request->menu_bg_color,
            'menu_text_color' => $request->menu_text_color,
            'header_bg_color' => $request->header_bg_color,
            'header_text_color' => $request->header_text_color,
        ]);
    }
}
