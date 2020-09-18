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

Route::get('/','RegisterExternalController@welcome');

Route::post('/formSubmit','RegisterExternalController@sign_up');
Route::post('/sign-in','AuthController@sign_in');
Route::post('/log-out','AuthController@log_out');


// Route::group(['middleware' => 'auth'], function () {
    Route::get('/build','HomeController@index')->middleware('auth');
    // Route::get('/details','UserController@user_details');
    Route::get('/final','UserController@final');
    Route::get('/edit','UserController@edit');
    Route::post('/user/edit','UserController@edit_user');
    // Route::post('/log-out','UserController@log_out');
// });
Auth::routes();
Route::get('/portfolio/{slug}','UserController@share');
Route::get('/details/portfolio/{slug}','UserController@share_details');

