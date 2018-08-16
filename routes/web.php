<?php

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


Route::get('/','MainController@index');
Route::post('/registration','AuthenticationController@registration');
Route::post('/login','AuthenticationController@login');
Route::get('/logout','AuthenticationController@logout');
Route::get('/dashboard','DashboardController@index')->middleware('auth');

