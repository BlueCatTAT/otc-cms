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
    Route::get('/{id}', 'WithdrawController@show')->name('withdraw_detail');
    Route::post('/{id}/audit', 'WithdrawController@audit')->name('withdraw_audit');
    Route::get('/{id}/audit-confirm-modal', 'WithdrawController@auditConfirmModal')->name('withdraw_audit_confirm_modal');
    Route::get('/log', 'WithdrawController@logList')->name('withdraw_log');
});

Route::prefix('cms-user')->middleware(['role:admin'])->group(function() {
    Route::get('/', 'CmsUserController@index')->name('cms_user_list');
    Route::get('/{id}', 'CmsUserController@show')->name('cms_user_detail');
    Route::post('/{id}', 'CmsUserController@update')->name('cms_user_update');
});
