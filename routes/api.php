<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/home','Api\HomeApi@home');
Route::get('/product/{slug}','Api\ProductApi@detail');
Route::post('make-review/{slug}','Api\ReviewApi@makeReview');
Route::post('add-tocart/{slug}','Api\CartApi@addToCart');
Route::get('get-cart','Api\CartApi@getCart');
Route::post('update-cart-qty','Api\CartApi@updateQty');
Route::post('remove-cart','Api\CartApi@removeCart');
Route::post('checkout','Api\CartApi@checkout');
Route::get('order','Api\CartApi@order');
Route::post('change-password','Api\AuthApi@changePassword');
