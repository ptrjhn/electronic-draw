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

Route::post('register', 'API\RaffleManagementController@register');
Route::post('save-winner', 'API\RaffleManagementController@saveWinner');

// Route::group(['middleware' => ['auth']], function()
// {
//     Route::post('setting/update-fullname', 'API\SettingController@updateFullname');
//     Route::post('setting/update-email', 'API\SettingController@updateEmail');
//     Route::post('setting/change-password', 'API\SettingController@changePassword');
// });



Route::fallback(function () {
    return abort(404);
});
