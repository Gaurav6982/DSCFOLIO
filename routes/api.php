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
Route::group([

    'middleware' => 'api',
], function ($router) {
    Route::post('login', 'NAuthController@login');
    Route::post('logout', 'NAuthController@logout');
    Route::post('refresh', 'NAuthController@refresh');  
    Route::post('register', 'NAuthController@register');
});

Route::middleware(['api', 'auth'])->group(function () {
    Route::post('user', 'NAuthController@me');
    Route::post('details','UserController@user_details');
    Route::post('/get-username','UserController@getusername');
    Route::post('/submit','UserController@submit');
    Route::post('/get-slug','UserController@getslug');
    Route::post('/get-image','UserController@getimage');
    Route::post('/get-resume','UserController@getresume');
    Route::post('/user/edit','UserController@edit_user');
    
});
// Route::group([

//     'middleware' => ['api','auth'],
// ], function () {
    

    
// });

