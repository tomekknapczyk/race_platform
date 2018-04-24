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

Route::get('/', 'HomeController@index')->name('home');

// Settings
Route::get('settings', 'UserController@settings')->name('settings');
Route::post('changePassword', 'UserController@changePassword')->name('changePassword');

// Profile
Route::get('driver-profile', 'UserController@driverProfile')->name('driver-profile');
Route::get('pilot-profile', 'UserController@pilotProfile')->name('pilot-profile');
Route::get('car', 'UserController@car')->name('car');
Route::post('saveDriver', 'UserController@saveDriver')->name('saveDriver');
Route::post('savePilot', 'UserController@savePilot')->name('savePilot');
Route::post('saveCar', 'UserController@saveCar')->name('saveCar');