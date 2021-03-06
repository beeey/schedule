<?php

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

Route::middleware('auth')->group(function () {
    Route::get('schedules/authored', 'ScheduleController@indexOfAuthored');
    Route::get('schedules/attending', 'ScheduleController@indexOfAttending');
    Route::get('schedules', 'ScheduleController@index');
    Route::post('schedules', 'ScheduleController@store');
    Route::put('schedules/{schedule}', 'ScheduleController@update');
    Route::delete('schedules/{schedule}', 'ScheduleController@delete');
});
