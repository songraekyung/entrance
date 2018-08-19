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
    return view('welcome');
});
Route::get('/exercise-one', 'ExerciseController@exerciseOne');
Route::get('/exercise-two', 'ExerciseController@exerciseTwo');
Route::get('/exercise-three', 'ExerciseController@exerciseThree');
Route::post('/exercise-amounts', 'ExerciseController@exerciseAmounts');