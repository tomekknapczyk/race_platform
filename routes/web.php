<?php
Auth::routes();
Route::get('register/verify/{confirmationCode}', 'Auth\RegisterController@confirm')->name('confirmation_path');

Route::get('/', 'GuestController@index');
Route::get('aktualnosci', 'NewsController@showAll');
Route::get('aktualnosc/{id}', 'NewsController@show')->name('aktualnosc');
Route::get('kierowcy_rajdowi', 'GuestController@drivers')->name('kierowcy');
Route::get('kierowca_rajdowy/{id}/{name?}', 'GuestController@driver')->name('kierowca');
Route::get('pilot_rajdowy/{id}/{name?}', 'GuestController@pilot')->name('pilot');
Route::get('piloci_rajdowi', 'GuestController@pilots')->name('piloci');
Route::get('video', 'GuestController@video');
Route::get('wyniki', 'GuestController@wyniki');
Route::get('live_wyniki', 'GuestController@live_wyniki');
Route::get('terminarz', 'GuestController@terminarz');
Route::get('runda/{id}', 'GuestController@runda');
Route::get('dokumenty', 'GuestController@dokumenty');
Route::get('podium/{id}', 'GuestController@podium');
Route::get('klasyfikacja-roczna/{id}', 'GuestController@roczna');
Route::get('regulamin', 'GuestController@regulamin');
Route::get('polityka_prywatnosci', 'GuestController@policy');
Route::post('rank_frame', 'GuestController@rank_frame')->name('rank_frame');
Route::get('media', 'GuestController@media')->name('media');
Route::get('redakcja/{id}', 'GuestController@redakcja')->name('redakcja');
Route::get('akredytacje/{id}', 'GuestController@akredytacje')->name('akredytacje');
Route::post('comparsion', 'GuestController@comparsion')->name('comparsion');

Route::get('dashboard', 'HomeController@index')->name('home');
Route::get('start-list/{id}', 'HomeController@startList')->name('startList');
Route::get('sign-list/{id}', 'HomeController@signList')->name('signList');
Route::get('rank/{id}', 'HomeController@rank')->name('rank');
Route::get('team_rank/{id}', 'HomeController@team_rank')->name('rank');
Route::get('rajd/{id}', 'HomeController@rajd')->name('rajd');

Route::get('rank2017', function(){
    return view('rank2017');
});
Route::get('rank2018', function(){
    return view('rank2018');
});
Route::get('rank2016', function(){
    return view('rank2016');
});
Route::get('register_form/{id}', 'HomeController@register_form')->name('register_form');
Route::post('getKlasa', 'HomeController@getKlasa')->name('getKlasa');
Route::post('getKlasaByNr', 'HomeController@getKlasaByNr')->name('getKlasa');
Route::post('getPilot', 'HomeController@getPilot')->name('getPilot');
Route::post('getPilotByName', 'HomeController@getPilotByName')->name('getPilotByName');
Route::post('getPilotById', 'HomeController@getPilotById')->name('getPilotById');
Route::post('getDriver', 'HomeController@getDriver')->name('getDriver');
Route::post('getDriverById', 'HomeController@getDriverById')->name('getDriverById');
Route::post('getPilotUid', 'HomeController@getPilotUid')->name('getPilotUid');
Route::post('getCar', 'HomeController@getCar')->name('getCar');
Route::post('getCarByNr', 'HomeController@getCarByNr')->name('getCar');
Route::post('sign', 'SignController@sign')->name('sign');
Route::post('editSignUser', 'SignController@editSignUser')->name('editSignUser');
Route::post('editSignPilot', 'SignController@editSignPilot')->name('editSignPilot');
Route::post('signPress', 'SignController@signPress')->name('signPress');
Route::post('editSignPress', 'SignController@editSignPress')->name('editSignPress');
Route::post('editSignPressAdmin', 'SignController@editSignPressAdmin')->name('editSignPressAdmin');
Route::post('deleteSign', 'SignController@deleteSign')->name('deleteSign');
Route::post('getStaff', 'SignController@getStaff')->name('getStaff');
Route::get('accreditation_pdf/{id}', 'SignController@accreditation_pdf')->name('accreditation_pdf');

// Settings
Route::get('settings', 'UserController@settings')->name('settings');
Route::post('changePassword', 'UserController@changePassword')->name('changePassword');
Route::post('regenerateUid', 'UserController@regenerateUid')->name('regenerateUid');

// Profile
Route::get('profile', 'UserController@driverProfile')->name('profile');
Route::get('pilots', 'UserController@pilots')->name('pilots')->middleware('driver');
Route::get('staff', 'UserController@staff')->name('staff')->middleware('press');
Route::get('cars', 'UserController@cars')->name('cars')->middleware('driver');
Route::get('car', 'UserController@car')->name('car');
Route::post('saveDriver', 'UserController@saveDriver')->name('saveDriver');
Route::post('savePilot', 'UserController@savePilot')->name('savePilot');
Route::post('saveStaff', 'UserController@saveStaff')->name('saveStaff');
Route::post('saveCar', 'UserController@saveCar')->name('saveCar');
Route::post('deleteCar', 'UserController@deleteCar')->name('deleteCar');
Route::post('deletePilot', 'UserController@deletePilot')->name('deletePilot');
Route::post('deleteStaff', 'UserController@deleteStaff')->name('deleteStaff');
Route::post('banUser', 'UserController@banUser')->name('banUser');
Route::post('unbanUser', 'UserController@unbanUser')->name('unbanUser');
Route::post('deleteProfile', 'UserController@deleteProfile')->name('deleteProfile');

// Teamy
Route::get('teams', 'TeamController@index')->name('teams');
Route::get('team/{id}', 'TeamController@show')->name('team');
Route::get('user-team', 'TeamController@dashboard')->name('userTeam');
Route::post('saveTeam', 'TeamController@save')->name('saveTeam');
Route::post('deleteTeam', 'TeamController@delete')->name('deleteTeam');
Route::post('saveTeamTitle', 'TeamController@saveTitle')->name('saveTeamTitle');
Route::post('sendTeamRequest', 'TeamController@sendTeamRequest')->name('sendTeamRequest');
Route::post('acceptRequest', 'TeamController@acceptRequest')->name('acceptRequest');
Route::post('deleteRequest', 'TeamController@deleteRequest')->name('deleteRequest');
Route::post('leaveTeam', 'TeamController@leaveTeam')->name('leaveTeam');
Route::post('editTeam', 'TeamController@edit')->name('editTeam');

// Admin panel
Route::group(['middleware' => 'admin'], function() {
    Route::get('races', 'RaceController@races')->name('races');
    Route::post('saveRace', 'RaceController@saveRace')->name('saveRace');
    Route::post('deleteRace', 'RaceController@deleteRace')->name('deleteRace');

    Route::get('race/{id}', 'RaceController@race')->name('race');
    Route::post('saveRound', 'RaceController@saveRound')->name('saveRound');
    Route::post('deleteRound', 'RaceController@deleteRound')->name('deleteRound');
    Route::post('addSection', 'RaceController@addSection')->name('addSection');

    Route::post('addLaurel', 'UserController@addLaurel')->name('addLaurel');
    Route::post('deleteLaurel', 'UserController@deleteLaurel')->name('deleteLaurel');

    Route::get('editRound/{id}', 'RaceController@editRound')->name('editRound');
    Route::get('newRound/{id}', 'RaceController@newRound')->name('newRound');
    Route::get('round/{id}', 'RaceController@round')->name('round');
    Route::get('list/{id}', 'RaceController@list')->name('list');
    Route::get('osy/{id}', 'RaceController@osy')->name('osy');
    Route::post('saveOs', 'RaceController@saveOs')->name('saveOs');
    Route::post('deleteOs', 'RaceController@deleteOs')->name('deleteOs');
    Route::post('updateOs', 'RaceController@updateOs')->name('updateOs');
    Route::get('accreditations/{id}', 'RaceController@accreditations')->name('accreditations');
    
    Route::post('signFormStatus', 'SignController@signFormStatus')->name('signFormStatus');
    Route::post('editSign', 'SignController@editSign')->name('editSign');
    Route::post('addSign', 'SignController@addSign')->name('addSign');
    Route::post('cancelSign', 'SignController@cancelSign')->name('cancelSign');
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
    Route::get('edycja_regulaminu', 'HomeController@terms')->name('edit_terms');
    Route::post('saveTerms', 'HomeController@saveTerms')->name('saveTerms');
    Route::get('edycja_polityki', 'HomeController@policy')->name('edit_policy');
    Route::post('savePolicy', 'HomeController@savePolicy')->name('savePolicy');

    Route::get('edit_live_video', 'HomeController@edit_live_video')->name('edit_live_video');
    Route::post('save_live_video', 'HomeController@save_live_video')->name('save_live_video');

    Route::get('edit_live_wyniki', 'HomeController@edit_live_wyniki')->name('edit_live_wyniki');
    Route::post('save_live_wyniki', 'HomeController@save_live_wyniki')->name('save_live_wyniki');

    Route::get('edit_promoted', 'HomeController@edit_promoted')->name('edit_promoted');
    Route::post('save_promoted', 'HomeController@save_promoted')->name('save_promoted');

    Route::get('edit-teams', 'HomeController@teams')->name('adminTeams');

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

    // Tabele do transmisji
    Route::get('tabele', 'TabelaController@index')->name('tables');
    Route::get('import_users', 'TabelaController@users')->name('import_users');
    Route::get('edycja_tabeli/{id}', 'TabelaController@edycja_tabeli')->name('edycja_tabeli');
    Route::post('import_users', 'TabelaController@import_users')->name('import_users');
    Route::post('editImportUser', 'TabelaController@edit_user')->name('edit_import_users');
    Route::post('deleteImportUser', 'TabelaController@delete_user')->name('delete_import_user');
    Route::post('add_import_users', 'TabelaController@add_import_users')->name('add_import_users');
    Route::post('clear_import_users', 'TabelaController@clear_import_users')->name('clear_import_users');
    Route::post('set_active_table', 'TabelaController@set_active_table')->name('set_active_table');

    Route::post('saveTable', 'TabelaController@save')->name('saveTable');
    Route::post('saveTableUsers', 'TabelaController@saveTableUsers')->name('saveTableUsers');
    Route::post('deleteTable', 'TabelaController@delete')->name('deleteTable');
    Route::post('addTableUsers', 'TabelaController@addTableUsers')->name('addTableUsers');
});

Route::get('aktywna', 'TabelaController@active')->name('active_table');
Route::get('tabela/{id}', 'TabelaController@show')->name('table');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
     // \UniSharp\LaravelFilemanager\Lfm::routes();
    '\vendor\unisharp\LaravelFilemanager\Lfm::routes()';
 });