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

Route::get('encrypt', 'App\Http\Controllers\Controller@encryptIndex')->name('encryptPage');
Route::post('enc-dec-data', 'App\Http\Controllers\Controller@changeEncDecData')->name('web.enc-dec-data');

Route::group(['prefix'=>'admin'],function(){
    Route::get('login', 'App\Http\Controllers\Admin\AuthController@login')->name('admin.login');
    Route::post('login', 'App\Http\Controllers\Admin\AuthController@login_post')->name('admin.login.post');
});
Route::group(['prefix'=>'website'],function(){
    Route::get('login', 'App\Http\Controllers\Website\AuthController@login')->name('website.login');
    Route::post('login', 'App\Http\Controllers\Website\AuthController@login_post')->name('website.login.post');
    Route::get('signup', 'App\Http\Controllers\Website\AuthController@signup')->name('website.signup');
    Route::post('signup', 'App\Http\Controllers\Website\AuthController@signup_post')->name('website.signup.post');
    Route::get('validate', 'App\Http\Controllers\Website\AuthController@validate_user')->name('website.validate');
    Route::post('validate', 'App\Http\Controllers\Website\AuthController@validate_post')->name('website.validate.post');
    Route::get('otp-verification', 'App\Http\Controllers\Website\AuthController@otp_verification')->name('website.otp-verification');
    Route::post('otp-verification', 'App\Http\Controllers\Website\AuthController@otp_verification_post')->name('website.otp-verification.post');
    Route::get('logout', 'App\Http\Controllers\Website\AuthController@logout')->name('website.logout');
    
    Route::get('home-page', 'App\Http\Controllers\Website\HomeController@home_page')->name('website.home-page');

});