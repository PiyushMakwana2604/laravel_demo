<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function(){
    Route::middleware('decryptReq')->group(function(){
        Route::post('signup','App\Http\Controllers\Api\AuthController@signup')->name('customer-signup');
        Route::post('login','App\Http\Controllers\Api\AuthController@login')->name('customer-login');
        Route::post('otp','App\Http\Controllers\Api\AuthController@otp')->name('customer-otp');
        Route::post('otp-verify','App\Http\Controllers\Api\AuthController@otp_verify')->name('customer-otp_verify');
    });
});
Route::prefix('v1')->group(function(){
    Route::middleware('decryptReq')->group(function(){
        Route::middleware('auth:api')->group(function(){
            Route::post('logout','App\Http\Controllers\Api\AuthController@logout')->name('customer-logout');
            // Route::post('otp','App\Http\Controllers\Api\AuthController@otp')->name('customer-otp');
            // Route::post('otp-verify','App\Http\Controllers\Api\AuthController@otp_verify')->name('customer-otp_verify');
            Route::get('view-profile','App\Http\Controllers\Api\AuthController@view_profile')->name('customer-view_profile');
            Route::post('change_pass','App\Http\Controllers\Api\AuthController@change_pass')->name('customer-change_pass');


            Route::get('store-listing','App\Http\Controllers\Api\HomePageController@store_listing')->name('customer-store_listing');
            Route::get('store-details','App\Http\Controllers\Api\HomePageController@store_details')->name('customer-store_details');
            Route::get('product-search','App\Http\Controllers\Api\HomePageController@product_search')->name('customer-product_search');
            Route::get('banner','App\Http\Controllers\Api\HomePageController@banner')->name('customer-banner');
            Route::get('top-deals','App\Http\Controllers\Api\HomePageController@top_deals')->name('customer-top_deals');
            Route::get('new-arrivals','App\Http\Controllers\Api\HomePageController@new_arrivals')->name('customer-new_arrivals');
            Route::get('product-details','App\Http\Controllers\Api\HomePageController@product_details')->name('customer-product_details');
            Route::get('product-list','App\Http\Controllers\Api\HomePageController@product_list')->name('customer-product_list');
            Route::post('add-address','App\Http\Controllers\Api\HomePageController@add_address')->name('customer-add_address');
            Route::post('edit-address','App\Http\Controllers\Api\HomePageController@edit_address')->name('customer-edit_address');
            Route::post('delete-address','App\Http\Controllers\Api\HomePageController@delete_address')->name('customer-delete_address');
            Route::post('edit-user','App\Http\Controllers\Api\HomePageController@edit_user')->name('customer-edit_user');
            Route::post('add-cart','App\Http\Controllers\Api\HomePageController@add_cart')->name('customer-add_cart');
            Route::get('cart-details','App\Http\Controllers\Api\HomePageController@cart_details')->name('customer-cart_details');
            Route::post('add-product_review','App\Http\Controllers\Api\HomePageController@add_product_review')->name('customer-add_product_review');
            Route::get('product-review-list','App\Http\Controllers\Api\HomePageController@product_review_list')->name('customer-product_review_list');
        });
    });
});