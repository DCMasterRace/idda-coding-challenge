<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// property
Route::get('/properties', 'PropertyController@show');
Route::post('/add-property', 'PropertyController@add');

// property analytic
Route::get('/property-analytics', 'PropertyAnalyticController@show');
Route::post('/property-analytics/add', 'PropertyAnalyticController@add');
Route::post('/property-analytics/update/{id}', 'PropertyAnalyticController@update');


// analytic type
Route::get('/analytic', 'AnalyticTypeController@show');
Route::post('/add-analytic', 'AnalyticTypeController@add');


// Get info
Route::get('/property-analytics/{params}/{val}', 'PropertyAnalyticController@getSummary');

