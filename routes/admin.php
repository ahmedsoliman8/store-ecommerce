<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
Route::group(['namespace'=>'Dashboard','prefix'=>'admin','middleware'=>'auth:admin'],function (){
    Route::get('/','DashboardController@index')->name('admin.dashboard');
    Route::group(['prefix'=>'settings'],function (){
        Route::get('shipping-methods/{type}','SettingsController@editShippingMethods')->name('edit.shipping.methods');
        Route::put('shipping-methods/{id}','SettingsController@updateShippingMethods')->name('update.shipping.methods');

    });
});
Route::group(['namespace'=>'Dashboard','prefix'=>'admin','middleware'=>'guest:admin'],function (){
    Route::get('login','LoginController@login')->name('admin.login');
    Route::post('login','LoginController@postLogin')->name('admin.post.login');
});
});













