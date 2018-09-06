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
Route::get('aktualnosci', 'NewsController@showAll');
Route::get('aktualnosc/{id}', 'NewsController@show');
Route::get('kierowcy', 'GuestController@drivers');
Route::get('kierowca/{id}', 'GuestController@driver');
Route::get('video', 'GuestController@video');
Route::get('wyniki', 'GuestController@wyniki');
Route::get('live_wyniki', 'GuestController@live_wyniki');
Route::get('terminarz', 'GuestController@terminarz');
Route::get('runda/{id}', 'GuestController@runda');
Route::get('dokumenty', 'GuestController@dokumenty');
Route::get('podium/{id}', 'GuestController@podium');
Route::get('klasyfikacja-roczna/{id}', 'GuestController@roczna');

Route::get('dashboard', 'HomeController@index')->name('home');
Route::get('start-list/{id}', 'HomeController@startList')->name('startList');
Route::get('sign-list/{id}', 'HomeController@signList')->name('signList');
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
    Route::post('changeFormVisibility', 'SignController@changeFormVisibility')->name('changeFormVisibility');
    Route::post('deleteList', 'SignController@deleteList')->name('deleteList');
    Route::post('saveRank', 'SignController@saveRank')->name('saveRank');

    Route::post('makeFile', 'SignController@makeFile')->name('makeFile');
    Route::post('makeFileSign', 'SignController@makeFileSign')->name('makeFileSign');

    Route::get('drivers', 'UserController@list')->name('drivers');
    Route::get('banner', 'HomeController@banner')->name('banner');
    Route::post('saveBanner', 'HomeController@saveBanner')->name('saveBanner');
    Route::get('contactInfo', 'HomeController@contactInfo')->name('contactInfo');
    Route::post('saveInfo', 'HomeController@saveInfo')->name('saveInfo');

    Route::get('edit_live_video', 'HomeController@edit_live_video')->name('edit_live_video');
    Route::post('save_live_video', 'HomeController@save_live_video')->name('save_live_video');

    Route::get('edit_live_wyniki', 'HomeController@edit_live_wyniki')->name('edit_live_wyniki');
    Route::post('save_live_wyniki', 'HomeController@save_live_wyniki')->name('save_live_wyniki');

    Route::get('edit_promoted', 'HomeController@edit_promoted')->name('edit_promoted');
    Route::post('save_promoted', 'HomeController@save_promoted')->name('save_promoted');

    Route::get('news', 'NewsController@index')->name('news');
    Route::get('newPost', 'NewsController@new')->name('newPost');
    Route::post('savePost', 'NewsController@save')->name('savePost');
    Route::get('editPost/{id}', 'NewsController@edit')->name('editPost');
    Route::post('deleteNews', 'NewsController@delete')->name('deleteNews');

    Route::get('partners', 'PartnerController@index')->name('partners');
    Route::get('newPartner', 'PartnerController@new')->name('newPartner');
    Route::post('savePartner', 'PartnerController@save')->name('savePartner');
    Route::get('editPartner/{id}', 'PartnerController@edit')->name('editPartner');
    Route::post('deletePartner', 'PartnerController@delete')->name('deletePartner');

    Route::get('docs', 'DocsController@index')->name('docs');
    Route::get('newDoc', 'DocsController@new')->name('newDoc');
    Route::post('saveDoc', 'DocsController@save')->name('saveDoc');
    Route::get('editDoc/{id}', 'DocsController@edit')->name('editDoc');
    Route::post('deleteDoc', 'DocsController@delete')->name('deleteDoc');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
     // \UniSharp\LaravelFilemanager\Lfm::routes();
    '\vendor\unisharp\LaravelFilemanager\Lfm::routes()';
 });