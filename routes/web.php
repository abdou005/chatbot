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
Route::get('/', function () {
    return redirect('login');
//    return view('welcome');
});
Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', 'UserController@getProfile')->name('profile');
    Route::post('/user/{id}', 'UserController@updateUser')->name('user-update');


});
Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/graph/user', 'GraphController@getGraphUser')->name('users-stat');
    Route::get('/graph/group', 'GraphController@getGraphGroup')->name('groups-stat');
    Route::get('/graph/question', 'GraphController@getGraphQuestion')->name('questions-stat');


    Route::get('/user', 'UserController@getusers')->name('user');
    Route::post('/user', 'UserController@addUser')->name('user-create');
    Route::delete('/user/{id}', 'UserController@removeUser')->name('user-remove');
    Route::post('/user/status/{id}', 'UserController@updateStatus')->name('user-status');

    Route::get('/group', 'GroupController@getGroups')->name('group');
    Route::post('/group', 'GroupController@createGroup')->name('group-create');
    Route::post('/group/{id}', 'GroupController@updateGroup')->name('group-update');
    Route::get('/group/{id}', 'GroupController@findGroup')->name('group-find');
    Route::delete('/group/{id}', 'GroupController@removeGroup')->name('group-remove');

    Route::get('/groups-select', 'GroupController@getGroupsSelect')->name('group-select');

    Route::get('/question', 'QuestionController@getQuestions')->name('question');
    Route::post('/question', 'QuestionController@createQuestion')->name('question-create');
    Route::post('/question/{id}', 'QuestionController@updateQuestion')->name('question-update');
    Route::get('/question/{id}', 'QuestionController@findQuestion')->name('question-find');
    Route::delete('/question/{id}', 'QuestionController@removeQuestion')->name('question-remove');
});