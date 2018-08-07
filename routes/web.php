<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'GuestController@index');

Route::get('dashboard', 'HomeController@index')->name('home');
Route::get('start-list/{id}', 'HomeController@startList')->name('startList');
Route::get('rank/{id}', 'HomeController@rank')->name('rank');
Route::get('register_form/{id}', 'HomeController@register_form')->name('register_form');
Route::post('getKlasa', 'HomeController@getKlasa')->name('getKlasa');
Route::post('getPilot', 'HomeController@getPilot')->name('getPilot');
Route::post('getCar', 'HomeController@getCar')->name('getCar');
Route::post('sign', 'SignController@sign')->name('sign');

// Settings
Route::get('settings', 'UserController@settings')->name('settings');
Route::post('changePassword', 'UserController@changePassword')->name('changePassword');

// Profile
Route::get('driver-profile', 'UserController@driverProfile')->name('driver-profile');
Route::get('pilots', 'UserController@pilots')->name('pilots');
Route::get('cars', 'UserController@cars')->name('cars');
Route::get('pilot-profile', 'UserController@pilotProfile')->name('pilot-profile');
Route::get('car', 'UserController@car')->name('car');
Route::post('saveDriver', 'UserController@saveDriver')->name('saveDriver');
Route::post('savePilot', 'UserController@savePilot')->name('savePilot');
Route::post('saveCar', 'UserController@saveCar')->name('saveCar');
Route::post('deleteCar', 'UserController@deleteCar')->name('deleteCar');
Route::post('deletePilot', 'UserController@deletePilot')->name('deletePilot');

// Admin panel
Route::group(['middleware' => 'admin'], function() {
    Route::get('races', 'RaceController@races')->name('races');
    Route::post('saveRace', 'RaceController@saveRace')->name('saveRace');
    Route::post('deleteRace', 'RaceController@deleteRace')->name('deleteRace');

    Route::get('race/{id}', 'RaceController@race')->name('race');
    Route::post('saveRound', 'RaceController@saveRound')->name('saveRound');
    Route::post('deleteRound', 'RaceController@deleteRound')->name('deleteRound');

    Route::get('round/{id}', 'RaceController@round')->name('round');
    Route::get('list/{id}', 'RaceController@list')->name('list');
    
    Route::post('signFormStatus', 'SignController@signFormStatus')->name('signFormStatus');
    Route::post('editSign', 'SignController@editSign')->name('editSign');
    Route::post('addSign', 'SignController@addSign')->name('addSign');
    Route::post('cancelSign', 'SignController@cancelSign')->name('cancelSign');
    Route::post('deleteSign', 'SignController@deleteSign')->name('deleteSign');
    Route::post('enableSign', 'SignController@enableSign')->name('enableSign');
    Route::post('update-position', 'SignController@updatePosition')->name('updatePosition');

    Route::post('generateList', 'SignController@generateList')->name('generateList');
    Route::post('deleteList', 'SignController@deleteList')->name('deleteList');
    Route::post('saveRank', 'SignController@saveRank')->name('saveRank');

    Route::post('makeFile', 'SignController@makeFile')->name('makeFile');
});