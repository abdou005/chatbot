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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('register', 'Api\AuthController@registerUser')->name('user.register');
Route::post('login', 'Api\AuthController@loginUser')->name('user.login');

Route::group(['middleware' => 'unique-auth'], function () {
    Route::post('logout', 'Api\AuthController@logoutUser')->name('user.logout');
    Route::get('my-profile', 'Api\UserController@getProfile')->name('user.my-profile-get');

    Route::get('groups', 'Api\GroupController@getGroups')->name('groups-get');
    Route::get('groups/{groupId}/questions', 'Api\QuestionController@getQuestionsByGroup')->name('group-questions-get');

    Route::post('response-to-question', 'Api\HistoryController@responseToQuestion')->name('response-to-question');
});