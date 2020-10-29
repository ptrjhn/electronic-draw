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

// Login page
Route::get('/', function () {
  if (Auth::check())
    return redirect('/events');

  return redirect('/login');
});

Auth::routes();

// Auth
Route::get('login', 'Auth\LoginController@index');

Route::post('login', 'Auth\LoginController@login')->name('login');

Route::get('logout', 'Auth\LogoutController@logout');

Route::group(['middleware' => ['auth']], function () {
  Route::get('events', 'Administration\EventController@index');
  Route::get('members', 'Administration\MemberController@index');

  Route::get('events/{slug}', 'Administration\EventController@view');

  Route::get('events/{slug}/spinner', 'Administration\EventController@viewSpinner');
  Route::get('events/{slug}/draw/{prize_slug}', 'Administration\EventController@draw');
  Route::get('events/{slug}/prizes', 'Administration\EventController@viewPrizes');
  Route::get('events/{slug}/winners', 'Administration\EventController@viewWinners');

  Route::get('users', 'Administration\UserController@index');

  Route::get('settings/help', 'Administration\HelpController@index');

  Route::get('settings', 'Administration\SettingsController@index');

  Route::post('setting/update-fullname', 'SettingController@updateFullname');
  Route::post('setting/update-email', 'SettingController@updateEmail');
  Route::post('setting/change-password', 'SettingController@changePassword');
});

// Thank you page
Route::get('thank-you', 'EventController@thankyou');

// Event Details
Route::get('events/{slug}/ticket-inquiry', 'EventController@view');

// Event registration
Route::get('{slug}/registration', 'EventController@registration');

Route::group(['prefix' => 'api/administration'], function () {

        Route::get('events', 'API\Administration\EventController@index')->name('admin-events.index');
        
        Route::group(['prefix' => 'event'], function () {
            Route::post('', 'API\Administration\EventController@store')->name('admin-events.store');
            Route::put('{id}/update', 'API\Administration\EventController@update')->name('admin-events.update');
            Route::get('{id}/edit', 'API\Administration\EventController@edit')->name('admin-events.update');
            Route::delete('{id}/delete', 'API\Administration\EventController@destroy')->name('admin-events.destroy');
            Route::get('participants', 'API\Administration\EventController@getParticipants')->name('admin-events.participants');
            Route::post('winner', 'API\Administration\EventController@saveWinner');

            Route::get('{id}/change-active', 'API\Administration\EventController@changeActive')->name('admin-events.update');
        });
        
        Route::resource('members','API\Administration\MemberController');
        Route::get('members-filter','API\Administration\MemberController@search');
        Route::resource('prizes','API\Administration\PrizeController');
        Route::resource('participants','API\Administration\ParticipantController');

        Route::get('players', 'API\Administration\PlayerController@index')->name('admin-players.index');

        Route::group(['prefix' => 'user'], function () {
            Route::get('','API\Administration\UserController@index')->name('admin.users.index');
            Route::post('', 'API\Administration\UserController@store')->name('admin-users.store');
            Route::put('{id}/update', 'API\Administration\UserController@update')->name('admin-users.update');
            Route::get('{id}/edit', 'API\Administration\UserController@edit')->name('admin-users.update');
        });
    });

Route::fallback(function () {
  return abort(404);
});
