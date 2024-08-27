<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware;
use App\Http\Controllers\Admin;
use App\Models\User;

###Auth###

    Route::get('/login','AuthController@showLogin');
    Route::post('/login','AuthController@postLogin');

    Route::get('/register','AuthController@showRegister');
    Route::post('/register','AuthController@postRegister');



Route::get('/logout','AuthController@logout');
Route::get('/profile','PageController@showProfile');

###Auth###
Route::get('/','PageController@home');
Route::get('/product/{slug}','ProductController@detail');
Route::get('/product','PageController@allProduct');

Route::get('/authuser',function(){
    $user= User::find(1);
    auth()->login($user);
    return auth()->user();
});

/*Admin route*/
Route::get('/admin/login','Admin\PageController@showLogin');
Route::post('/admin/login','Admin\PageController@login');
Route::group(['prefix'=>"admin",'namespace'=>"Admin"],function(){
    Route::post('/logout', 'PageController@logout');

    Route::get('/','PageController@showDashboard');
    Route::resource('/category', 'CategoryController');
    Route::resource('/color','ColorController');
    Route::resource('/brand','BrandController');
    Route::resource('/supplier', 'SupplierController');
    Route::resource('/income','IncomeController');
    Route::resource('/outcome','OutcomeController');

    //product route
    Route::resource('/product','ProductController');
    Route::post('product-upload','ProductController@imageUpload');
    Route::get('/product-add-transaction','ProductController@productAddTransaction');
    Route::get('/create-product-add/{slug}','ProductController@createProductAdd');
    Route::post('/create-product-add/{slug}','ProductController@storeProductAdd');
    Route::get('/product-remove-transaction','ProductController@productRemoveTransaction');
    Route::get('/product-remove/{slug}','ProductController@productRemove');
    Route::post('/product-remove/{slug}','ProductController@storeProductRemove');

    Route::get('/order','OrderController@all');
    Route::get('/change-order','OrderController@changeOrderStatus');

});
