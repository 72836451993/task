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
Route::get('/activate_user','AuthenticationController@activateComplete');
Route::get('/recover','AuthenticationController@recovery');
Route::get('/recover_process','AuthenticationController@recover_process');
Route::post('/recover_complete','AuthenticationController@recover_complete');
Route::post('/recover_account','AuthenticationController@recover_account');


Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard','DashboardController@index');
    Route::get('/logout','AuthenticationController@logout');
    Route::post('/activation','AuthenticationController@activateMe');

});