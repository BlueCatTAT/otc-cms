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
    Route::get('/', 'WithdrawController@index')
        ->name('withdraw_list');
    Route::get('/{id}', 'WithdrawController@show')
        ->name('withdraw_detail')
        ->middleware('withdraw.id');
    Route::post('/{id}/confirm', 'WithdrawController@confirm')
        ->name('withdraw_audit_confirm')
        ->middleware('withdraw.id');
    Route::post('/{id}/deny', 'WithdrawController@deny')
        ->name('withdraw_audit_deny')
        ->middleware('withdraw.id');
    Route::get('/{id}/audit-confirm-modal', 'WithdrawController@auditConfirmModal')
        ->name('withdraw_audit_confirm_modal')
        ->middleware('withdraw.id');
    Route::get('/{id}/audit-deny-modal', 'WithdrawController@auditDenyModal')
        ->name('withdraw_audit_deny_modal')
        ->middleware('withdraw.id');
    Route::get('/log', 'WithdrawController@logList')
        ->name('withdraw_log');
});

Route::prefix('cms-user')->middleware(['role:admin'])->group(function() {
    Route::get('/', 'CmsUserController@index')
        ->name('cms_user_list');
    Route::get('/{id}', 'CmsUserController@show')
        ->name('cms_user_detail');
    Route::post('/{id}', 'CmsUserController@update')
        ->name('cms_user_update');
});

Route::prefix('order')->group(function() {
    Route::get('/', 'OrderController@index')
        ->name('order_list');
    Route::get('/{id}', 'OrderController@show')
        ->name('order_detail')
        ->middleware('order.id');
    Route::get('/{id}/confirm-modal', 'OrderController@confirmModal')
        ->name('order_confirm_modal')
        ->middleware('order.id');
    Route::get('/{id}/cancel-modal', 'OrderController@cancelModal')
        ->name('order_cancel_modal')
        ->middleware('order.id');

    Route::post('/{id}/confirm', 'OrderController@confirm')
        ->name('order_confirm')
        ->middleware('order.id');
    Route::post('/{id}/cancel', 'OrderController@cancel')
        ->name('order_cancel')
        ->middleware('order.id');
});

Route::prefix('customer')->group(function() {
    Route::get('/', 'CustomerController@index')
        ->name('customer_list');
    Route::get('/{id}', 'CustomerController@show')
        ->name('customer_detail')
        ->middleware('customer.id');
    Route::get('/{id}/orders', 'CustomerController@orderList')
        ->name('customer_order_list')
        ->middleware('customer.id');
    Route::get('/{id}/ads', 'CustomerController@adList')
        ->name('customer_ad_list')
        ->middleware('customer.id');
    Route::get('/{id}/withdraws', 'CustomerController@withdrawList')
        ->name('customer_withdraw_list')
        ->middleware('customer.id');
});

Route::get('/commissions', 'CommissionController@getCommissionList');

Route::post('/upload/image', 'UploadController@image')
    ->name('upload_image');

Route::prefix('/adpicture')->group(function() {
    Route::get('/', 'AdPictureController@index')
        ->name('adpicture_list');
    Route::get('/add', 'AdPictureController@add')
        ->name('adpicture_add');
    Route::post('/', 'AdPictureController@save')
        ->name('adpicture_save');
    Route::post('/reorder', 'AdPictureController@reorder')
        ->name('adpicture_reorder');
});
