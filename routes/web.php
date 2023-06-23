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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@show')->name('home.show');

    Route::group(['middleware' => ['guest']], function () {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');
        Route::get('/register/refresh_captcha', 'RegisterController@refreshCaptcha')->name('register.refresh_captcha');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

        Route::get('/forgot-password', function () {
            return view('forgot-password');
        });
        Route::get('/no-permission', function () {
            return view('no-permission');
        });
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/admin', 'AdminController@index')->name('admin.index');
        Route::get('/admin/users', 'AdminController@users')->name('admin.users');
        Route::get('/admin/recent-searches', 'AdminController@recentSearches')->name('admin.recent-searches');
        Route::get('/admin/search-results/{id}', 'AdminController@searchResults')->name('admin.search-results');
        Route::get('/admin/generate-pdf/{searchId}/{docId}', 'AdminController@generatePDF')->name('admin.generate-pdf');

        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
        Route::post('/dashboard/search', 'DashboardController@search')->name('dashboard.search');
        Route::get('/dashboard/search', 'DashboardController@searchForm')->name('dashboard.search-form');
        Route::get('/dashboard/add-credit', 'DashboardController@addCredit')->name('dashboard.add-credit');
        Route::post('/dashboard/collect-payment', 'DashboardController@collectPayment')->name('dashboard.collect-payment');
        Route::get('/dashboard/payment-status/{id}', 'DashboardController@paymentStatus')->name('dashboard.payment-status');
        Route::post('/dashboard/payment-status/{id}', 'DashboardController@checkPaymentStatus')->name('dashboard.check-payment-status');
        Route::get('/dashboard/search-results/{id}', 'DashboardController@searchResults')->name('dashboard.search-results');
        Route::get('/dashboard/recent-searches', 'DashboardController@recentSearches')->name('dashboard.recent-searches');
        Route::get('/dashboard/generate-pdf/{searchId}/{docId}', 'DashboardController@generatePDF')->name('dashboard.generate-pdf');
    });
});
