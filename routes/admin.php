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
    Route::get("logout","LoginController@logout")->name("admin.logout");
    //Shippings
    Route::group(['prefix'=>'settings'],function (){
        Route::get('shipping-methods/{type}','SettingsController@editShippingMethods')->name('edit.shipping.methods');
        Route::put('shipping-methods/{id}','SettingsController@updateShippingMethods')->name('update.shipping.methods');
    });
    // Profile
    Route::group(['prefix'=>'profile'],function (){
        Route::get('edit','ProfileController@editProfile')->name('edit.profile');
        Route::put('update','ProfileController@updateProfile')->name('update.profile');
    });
    //Main Categories
    Route::group(['prefix'=>'main_categories'],function (){
        Route::get('/','MainCategoriesController@index')->name('admin.maincategories');
        Route::get('create','MainCategoriesController@create')->name('admin.maincategories.create');
        Route::post('store','MainCategoriesController@store')->name('admin.maincategories.store');
        Route::get('edit/{id}','MainCategoriesController@edit')->name('admin.maincategories.edit');
        Route::post('update/{id}','MainCategoriesController@update')->name('admin.maincategories.update');
        Route::get('delete/{id}','MainCategoriesController@destroy')->name('admin.maincategories.delete');
        Route::get('changeStatus/{id}','MainCategoriesController@changeStatus')->name('admin.maincategories.status');
    });

    //Brands
    Route::group(['prefix'=>'brands'],function (){
        Route::get('/','BrandController@index')->name('admin.brands');
        Route::get('create','BrandController@create')->name('admin.brands.create');
        Route::post('store','BrandController@store')->name('admin.brands.store');
        Route::get('edit/{id}','BrandController@edit')->name('admin.brands.edit');
        Route::post('update/{id}','BrandController@update')->name('admin.brands.update');
        Route::get('delete/{id}','BrandController@destroy')->name('admin.brands.delete');
        Route::get('changeStatus/{id}','BrandController@changeStatus')->name('admin.brands.status');
    });

    //Tags
    Route::group(['prefix'=>'tags'],function (){
        Route::get('/','TagController@index')->name('admin.tags');
        Route::get('create','TagController@create')->name('admin.tags.create');
        Route::post('store','TagController@store')->name('admin.tags.store');
        Route::get('edit/{id}','TagController@edit')->name('admin.tags.edit');
        Route::post('update/{id}','TagController@update')->name('admin.tags.update');
        Route::get('delete/{id}','TagController@destroy')->name('admin.tags.delete');
        Route::get('changeStatus/{id}','TagController@changeStatus')->name('admin.tags.status');
    });

    //Products
    Route::group(['prefix'=>'products'],function (){
        Route::get('/','ProductController@index')->name('admin.products');
        Route::get('create','ProductController@create')->name('admin.products.create');
        Route::post('store','ProductController@store')->name('admin.products.store');
        Route::get('edit/{id}','ProductController@edit')->name('admin.products.edit');
        Route::post('update/{id}','ProductController@update')->name('admin.products.update');
        Route::get('delete/{id}','ProductController@destroy')->name('admin.products.delete');
        Route::get('changeStatus/{id}','ProductController@changeStatus')->name('admin.products.status');
        Route::get('addImages/{id}','ProductController@addImages')->name('admin.products.add.images');
        Route::post('upload/image/{pid}','ProductController@upload_image')->name('admin.upload.image');
        Route::post('delete/image','ProductController@delete_image')->name('admin.delete.image');
        Route::get('characteristic/{id}','ProductController@characteristic')->name('admin.products.characteristic');
        Route::post('add_characteristic','ProductController@add_characteristic')->name('admin.products.add.characteristic');
        Route::get('remove_characteristic/{id}','ProductController@remove_characteristic')->name('admin.products.remove.characteristic');
        Route::get('edit_characteristic/{id}','ProductController@edit_characteristic')->name('admin.products.edit.characteristic');
        Route::post('update_characteristic/{id}','ProductController@update_characteristic')->name('admin.products.update.characteristic');







    });

    //Attributes
    Route::group(['prefix'=>'attributes'],function (){
        Route::get('/','AttributeController@index')->name('admin.attributes');
        Route::get('create','AttributeController@create')->name('admin.attributes.create');
        Route::post('store','AttributeController@store')->name('admin.attributes.store');
        Route::get('edit/{id}','AttributeController@edit')->name('admin.attributes.edit');
        Route::post('update/{id}','AttributeController@update')->name('admin.attributes.update');
        Route::get('delete/{id}','AttributeController@destroy')->name('admin.attributes.delete');

    });

    //Sliders
    Route::group(['prefix'=>'sliders'],function () {
        Route::get('addSliders', 'SliderController@addSliders')->name('admin.add.sliders');
        Route::post('upload/slider', 'SliderController@upload_slider')->name('admin.upload.slider');
        Route::post('delete/slider', 'SliderController@delete_slider')->name('admin.delete.slider');
    });





});
Route::group(['namespace'=>'Dashboard','prefix'=>'admin','middleware'=>'guest:admin'],function (){
    Route::get('login','LoginController@login')->name('admin.login');
    Route::post('login','LoginController@postLogin')->name('admin.post.login');
});
});














