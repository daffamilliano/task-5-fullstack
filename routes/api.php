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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
 
    Route::group(['middleware' => 'auth:api'], function(){
        Route::post('details', 'API\UserController@details');
        Route::post('create-new-articles', 'Articles\ArticlesController@store');
    });

    Route::namespace('Articles')->middleware('auth:api')->group(function(){
        Route::post('create-new-articles', 'ArticlesController@store');
        Route::post('delete-articles', 'ArticlesController@destroy');
    });

Route::get('Articles/{Articles}', 'Articles\ArticlesController@show');