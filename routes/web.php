<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//    return "<h1>hi</h1>";
//     // return view('welcome');
// });

// Route::get('/welcome',[App\Http\Controllers\WelcomeController::class,'index']);
Route::get('encrypt', 'App\Http\Controllers\Controller@encryptIndex')->name('encryptPage');
Route::post('enc-dec-data', 'App\Http\Controllers\Controller@changeEncDecData')->name('web.enc-dec-data');


Route::group(['prefix'=>'admin'],function(){
    Route::get('home', 'App\Http\Controllers\Admin\UserController@home')->name('admin.home');
    Route::get('login', 'App\Http\Controllers\Admin\AdminController@login')->name('admin.login');
    Route::post('login', 'App\Http\Controllers\Admin\AdminController@login_post')->name('admin.login.post');
    Route::get('register', 'App\Http\Controllers\Admin\AdminController@register')->name('admin.register');
    Route::post('register', 'App\Http\Controllers\Admin\AdminController@register_post')->name('admin.register.post');
    Route::get('list', 'App\Http\Controllers\Admin\UserController@list')->name('admin.list');
    Route::get('user_list', 'App\Http\Controllers\Admin\UserController@get_userlist')->name('admin.get_user_list');
    Route::get('logout', 'App\Http\Controllers\Admin\AdminController@logout')->name('admin.logout');
    Route::get('otp_verification', 'App\Http\Controllers\Admin\AdminController@otp_verification')->name('admin.otp_verification');
    Route::post('otp_verification', 'App\Http\Controllers\Admin\AdminController@otp_verification_post')->name('admin.otp_verification_post');
    Route::get('edit-form/{id}', 'App\Http\Controllers\Admin\UserController@edit_form')->name('admin.edit-form');
    Route::post('edit-form/{id}', 'App\Http\Controllers\Admin\UserController@edit_form_post')->name('admin.edit-form.post');
    Route::get('delete-user/{id}', 'App\Http\Controllers\Admin\UserController@delete_user')->name('admin.delete-user');
});
Route::group(['prefix'=>'website'],function(){
    Route::get('login', 'App\Http\Controllers\Website\AuthController@login')->name('website.login');
    Route::post('login', 'App\Http\Controllers\Website\AuthController@login_post')->name('website.login.post');
    Route::get('otp_verification', 'App\Http\Controllers\Website\AuthController@otp_verification')->name('website.otp_verification');
    Route::post('otp_verification', 'App\Http\Controllers\Website\AuthController@otp_verification_post')->name('website.otp_verification_post');
    Route::get('signup', 'App\Http\Controllers\Website\AuthController@signup')->name('website.signup');
    Route::post('signup', 'App\Http\Controllers\Website\AuthController@signup_post')->name('website.signup.post');
    Route::get('logout', 'App\Http\Controllers\Website\AuthController@logout')->name('website.logout');
    Route::get('contact-us', 'App\Http\Controllers\Website\AuthController@contact_us')->name('website.contact_us');
    Route::post('contact-us', 'App\Http\Controllers\Website\AuthController@contact_us_post')->name('website.contact_us.post');

    Route::get('home', 'App\Http\Controllers\Website\HomeController@home')->name('website.home');
    Route::get('about', 'App\Http\Controllers\Website\HomeController@about')->name('website.about');
    Route::get('product-list', 'App\Http\Controllers\Website\HomeController@product_list')->name('website.product_list');
    Route::post('product-sorting', 'App\Http\Controllers\Website\HomeController@product_sorting')->name('website.product_sorting');
    Route::post('product-filter', 'App\Http\Controllers\Website\HomeController@product_filter')->name('website.product_filter');
    Route::get('manage-products-seller', 'App\Http\Controllers\Website\HomeController@manage_products_seller')->name('website.manage_products_seller');
    Route::post('manage-products-seller', 'App\Http\Controllers\Website\HomeController@manage_products_post')->name('website.manage_products_post');
    Route::get('product-details/{product_id}', 'App\Http\Controllers\Website\HomeController@product_details')->name('website.product_details');
    Route::post('add-cart', 'App\Http\Controllers\Website\HomeController@add_cart')->name('website.add_cart');
    Route::get('cart', 'App\Http\Controllers\Website\HomeController@cart')->name('website.cart');
    Route::post('update-cart-quantity', 'App\Http\Controllers\Website\HomeController@update_cart_quantity')->name('website.update_cart_quantity');
    Route::post('delete-cart', 'App\Http\Controllers\Website\HomeController@delete_cart')->name('website.delete_cart');
    Route::get('select-address', 'App\Http\Controllers\Website\HomeController@select_address')->name('website.select_address');
    Route::get('order-summary', 'App\Http\Controllers\Website\HomeController@order_summary')->name('website.order_summary');
    Route::get('select-payment', 'App\Http\Controllers\Website\HomeController@select_payment')->name('website.select_payment');
    Route::get('add-order', 'App\Http\Controllers\Website\HomeController@add_order')->name('website.add_order');
    Route::get('my-order', 'App\Http\Controllers\Website\HomeController@my_order')->name('website.my_order');
    Route::get('my-order', 'App\Http\Controllers\Website\HomeController@my_order')->name('website.my_order');
    Route::get('upcoming-order-details/{order_id}', 'App\Http\Controllers\Website\HomeController@upcoming_order_details')->name('website.upcoming-order-details');
    Route::get('cancel-order', 'App\Http\Controllers\Website\HomeController@cancel_order')->name('website.cancel_order');
    Route::post('cancel-order', 'App\Http\Controllers\Website\HomeController@cancel_order_post')->name('website.cancel_order.post');

});
Route::group(['prefix'=>'welcome'],function(){
    Route::get('/',[App\Http\Controllers\WelcomeController::class,'index']);

});