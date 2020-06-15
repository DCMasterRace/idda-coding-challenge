<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PropertyAnalytic;
use App\Property;
use App\AnalyticType;

class PropertyAnalyticController extends Controller
{
    //

    public function show(){

        $property = PropertyAnalytic::all();
        return response()->json(['code' => 200, 'message' => '1', 'data' => $property], 200);

    }

    public function validates($request){
        // validate the required fields
        $validation = $request->validate([
            'property_id' => 'required',
            'analytic_type_id' => 'required',
            'value' => 'required'
        ]);

        // checking if property id and AnalyticType id is exist so that the data that added is valid in property and AnalyticType
        $property = Property::where('id', '=', $request->property_id)->first();
        $analyticType = PropertyAnalytic::where('id', '=', $request->analytic_type_id)->first();
        if($property && $analyticType){
            $data = [
                'property_id' => $request->property_id,
                'analytic_type_id' => $request->analytic_type_id,
                'value' => $request->value
            ];
            return $data;


        } else {
            return response()->json(['code' => 400, 'message' => 'Unable to save details.'], 400);
        }
    }

    public function add(Request $request){
        $data = $this->validates($request);
        $propertyAnalytic = PropertyAnalytic::create($data);
        return response()->json(['code' => 200, 'message' => 'Save Successful', 'data' => $propertyAnalytic], 200);
    }

    public function update(Request $request, $id){
        $data = $this->validates($request);
        $propertyAnalytic = PropertyAnalytic::find($id);
        $propertyAnalytic->update($data);
        return response()->json(['code' => 200, 'message' => 'Save Successful', 'data' => $propertyAnalytic], 200);
    }

    public function getSummary($params, $val){
        $params = strtolower($params);
        $propertyIds = Property::where($params, '=', $val)->pluck('id')->toArray();

        // Getting all the property analytic from the input params and value
        $pa = PropertyAnalytic::whereIn('property_id', $propertyIds)->get();
        $total = PropertyAnalytic::whereIn('property_id', $propertyIds)->count();
        $max = PropertyAnalytic::select('value')->whereIn('property_id', $propertyIds)->orderBy('value', 'desc')->value('value');
        $min = PropertyAnalytic::select('value')->whereIn('property_id', $propertyIds)->orderBy('value', 'asc')->value('value');
        // percentage with value
        $pwv = $pa->where('value', '!=', '')->count();
        // percentage without value
        $pwov = $pa->where('value', '=', '')->count();

        $pwv = $pwv / $total * 100 . "%";
        $pwov = $pwov / $total * 100 . "%";

        $data = [
            'min' => $min,
            'max' => $max,
            'Percentage with value' => $pwv,
            'Percentage without value' => $pwov,
        ];

        return response()->json(['code' => 200, 'message' => 'Save Successful', 'data' => $data], 200);
    }

}
