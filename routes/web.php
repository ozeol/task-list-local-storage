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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::resource('tasks', 'TaskController', [
    'only' => [
        'index', 'store', 'update'
    ]
]);




Route::post('/profile/{user}/{task}/', 'FollowsController@store');



Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');

Route::get('/task/{task}/edit', 'TaskController@edit')->name('task.edit');
Route::patch('/task/{task}',['uses' => 'TaskController@complete', 'as'=> 'task.complete']);

Route::delete('/task/{task}',['uses' => 'TaskController@delete', 'as'=> 'task.delete']);
