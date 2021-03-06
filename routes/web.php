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
    Route::post('/update-profile/{id}', 'ProfileController@updateUser')->name('user-update-profile');
    Route::get('/histories', 'UserController@histories')->name('histories');
    Route::get('/groups-select', 'GroupController@getGroupsSelect')->name('group-select');
    Route::get('/questions-select', 'GroupController@getQuestionsSelect')->name('question-select');

    Route::get('/group/{id}/questions', 'QuestionController@getQuestionsByGroup')->name('group-questions-wed');

    Route::get('/group/{id}/histories', 'UserController@getHistoriesByGroup')->name('group-histories');
    Route::post('/response-to-question/{id}', 'UserController@responseToQuestion')->name('response-to-question-web');

    Route::post('/group/{id}/add-question', 'UserController@addQuestionAndHistory')->name('add-question-and-history');
});

Route::group(['middleware' => ['auth', 'admin']], function () {

    Route::get('/graphs', 'GraphController@getGraphs')->name('graphs');
    Route::get('/graph/user', 'GraphController@getGraphUser')->name('users-stat');
    Route::get('/graph/group', 'GraphController@getGraphGroup')->name('groups-stat');
    Route::get('/graph/question', 'GraphController@getGraphQuestion')->name('questions-stat');


    Route::get('/user', 'UserController@getusers')->name('user');
    Route::post('/user', 'UserController@addUser')->name('user-create');
    Route::get('/user/{id}', 'UserController@findUser')->name('user-details');
    Route::post('/user/{id}', 'UserController@updateUser')->name('user-update');
    Route::delete('/user/{id}', 'UserController@removeUser')->name('user-remove');
    Route::post('/user/status/{id}', 'UserController@updateStatus')->name('user-status');

    Route::get('/group', 'GroupController@getGroups')->name('group');
    Route::post('/group', 'GroupController@createGroup')->name('group-create');
    Route::post('/group/{id}', 'GroupController@updateGroup')->name('group-update');
    Route::get('/group/{id}', 'GroupController@findGroup')->name('group-find');
    Route::delete('/group/{id}', 'GroupController@removeGroup')->name('group-remove');


    Route::get('/question', 'QuestionController@getQuestions')->name('question');
    Route::post('/question', 'QuestionController@createQuestion')->name('question-create');
    Route::post('/question/{id}', 'QuestionController@updateQuestion')->name('question-update');
    Route::get('/question/{id}', 'QuestionController@findQuestion')->name('question-find');
    Route::delete('/question/{id}', 'QuestionController@removeQuestion')->name('question-remove');
});