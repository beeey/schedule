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
    Route::get('schedule', 'CalendarController@index');
    Route::post('schedule', 'CalendarController@store');
    Route::put('schedule/{schedule}', 'CalendarController@update');
    Route::delete('schedule', 'CalendarController@delete');
});
