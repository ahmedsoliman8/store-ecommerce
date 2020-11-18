<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Site Routes
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
    Route::group(['namespace'=>'Site','middleware'=>['auth','verifyCode']],function (){

    });
    Route::group(['namespace'=>'Site','middleware'=>'auth'],function (){
        Route::get('/verify','VerificationCodeController@verify')->name('verify');
        Route::post('/verify/user','VerificationCodeController@verify_user')->name('verify_user');
    });
    Route::get('/','Site\SiteController@index')->name('site.index');
    Auth::routes();
});

