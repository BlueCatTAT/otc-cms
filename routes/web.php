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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('withdraw')->group(function() {
    Route::get('/', 'WithdrawController@index')->name('withdraw_list');
    Route::get('/log', 'WithdrawController@logList')->name('withdraw_log');
});
