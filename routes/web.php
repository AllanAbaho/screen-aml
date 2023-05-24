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
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});
Route::get('/dashboard/index', function () {
    return view('dashboard/index');
});
Route::get('/dashboard/add-credit', function () {
    return view('dashboard/add-credit');
});
Route::get('/dashboard/search-person', function () {
    return view('dashboard/search-person');
});
Route::get('/dashboard/search-company', function () {
    return view('dashboard/search-company');
});
Route::get('/forgot-password', function () {
    return view('forgot-password');
});
