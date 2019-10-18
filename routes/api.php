<?php

use Illuminate\Http\Request;

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
Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');
 
Route::group(['middleware' => 'auth.jwt'], function () {
    
    Route::get('logout', 'ApiController@logout');
 
    Route::get('user', 'ApiController@getAuthUser');
   // get available events
    Route::get('events', 'EventController@index');
   // get reservations for current user
    Route::get('reservations', 'ReservationController@index');
    // create reservation for user 
    Route::put('reservation', 'ReservationController@store');
    // cancel reservations	
    Route::delete('cancel/reservation', 'ReservationController@destroy');
   // get and event id is requeird 
    Route::get('tables', 'TableController@getAvailableTables');


});
