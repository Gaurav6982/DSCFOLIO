<?php

use Illuminate\Support\Facades\Route;

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

Route::post('/formSubmit','RegisterExternalController@sign_up');
Route::post('/sign_in','UserController@sign_in');
Route::post('/log-out','UserController@log_out');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/build','HomeController@index');
    Route::post('/submit','UserController@submit');
});
Auth::routes();
