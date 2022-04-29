<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Controllers\PagesController;
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


Route::get('/hello', function () {
    return 'Hello world';
});


Route::get('/patient', function () {
    return view('pages.patient');
});


Route::get('/login', function () {
    return view('pages.login');
});