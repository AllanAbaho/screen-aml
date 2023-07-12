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

Route::post('/update-balance', 'App\Http\Controllers\DashboardController@updateBalance')->name('dashboard.update-balance');
Route::get('/ursb/{entity}', 'HomeController@ursb');
Route::get('/getAccessToken', 'App\Http\Controllers\HomeController@getAccessToken');
Route::get('/getPerson/{nin}', 'App\Http\Controllers\HomeController@getPerson');
