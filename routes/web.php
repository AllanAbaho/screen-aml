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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'LoginController@show')->name('login.show');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

        Route::get('/forgot-password', function () {
            return view('forgot-password');
        });        

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
        Route::post('/dashboard/search', 'DashboardController@search')->name('dashboard.search');
        Route::get('/dashboard/search', 'DashboardController@searchForm')->name('dashboard.search-form');
        Route::get('/dashboard/search-results/{id}', 'DashboardController@searchResults')->name('dashboard.search-results');
        Route::get('/dashboard/get_business_registration_details/{entity}', 'DashboardController@get_business_registration_details')->name('dashboard.get_business_registration_details');
        Route::get('/dashboard/accesstkn', 'DashboardController@accesstkn')->name('dashboard.accesstkn');
        Route::get('/dashboard/generate-pdf/{searchId}/{docId}', 'DashboardController@generatePDF')->name('dashboard.generate-pdf');


        Route::get('/dashboard/add-credit', function () {
            return view('dashboard/add-credit');
        });        
    });
});
