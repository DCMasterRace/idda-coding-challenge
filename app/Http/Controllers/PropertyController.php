<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;

class PropertyController extends Controller
{
    //
    public function show(){

        $property = Property::all();
        return response()->json(['code' => 200, 'message' => '1', 'data' => $property], 200);

    }


    public function add(Request $request){
        $validation = $request->validate([
            'suburb' => 'required',
            'state' => 'required',
            'country' => 'required'
        ]);

        $data = [
            'suburb' => $request->suburb,
            'state' => $request->state,
            'country' => $request->country
        ];

        Property::create($data);

    }
}
