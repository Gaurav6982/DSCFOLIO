<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/formSubmit','RegisterExternalController@sign_up');
Route::post('/sign-in','AuthController@sign_in');
Route::post('/log-out','AuthController@log_out');
// Route::post('/user/edit','UserController@edit_user');
// Route::get('/details','UserController@user_details');

// Route::get('/get-slug','UserController@getslug');
// Route::post('/register','UserController@register');
// Route::post('/login','UserController@login');
// Route::post('/logout','UserController@logout');
// Route::get('/profile','UserController@profile');
// Route::get('/fetch/category','API\V1\Data\CategoriesController@index');