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


// Main Page Route


Route::view('/','sign-in')->name('sign-in');

Route::view('/dashboard','dashboard')->name('dashboard');

Route::view('/tables','tables')->name('tables');

Route::view('/sign-up','sign-up')->name('sign-up');


Route::view('/profile','profile')->name('profile');


