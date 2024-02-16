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
    Route::get('about-us', 'App\Http\Controllers\Website\HomeController@about_us')->name('website.about-us');
    Route::get('class-details', 'App\Http\Controllers\Website\HomeController@class_details')->name('website.class-details');
    Route::get('services', 'App\Http\Controllers\Website\HomeController@services')->name('website.services');
    Route::get('our-team', 'App\Http\Controllers\Website\HomeController@our_team')->name('website.our-team');
    Route::get('team-details/{id}', 'App\Http\Controllers\Website\HomeController@team_details')->name('website.team-details');
    Route::get('contact-us', 'App\Http\Controllers\Website\HomeController@contact_us')->name('website.contact-us');
    Route::get('class-timetable', 'App\Http\Controllers\Website\HomeController@class_timetable')->name('website.class-timetable');
    Route::get('bmi-calculator', 'App\Http\Controllers\Website\HomeController@bmi_calculator')->name('website.bmi-calculator');
    Route::get('gallery', 'App\Http\Controllers\Website\HomeController@gallery')->name('website.gallery');
    Route::get('blog', 'App\Http\Controllers\Website\HomeController@blog')->name('website.blog');
    Route::get('hotspot', 'App\Http\Controllers\Website\HomeController@hotspot')->name('website.hotspot');
    Route::post('calendar-crud-ajax', 'App\Http\Controllers\Website\HomeController@calendarEvents')->name('website.calendarEvents');


    Route::post('contact-us', 'App\Http\Controllers\Website\HomeController@contact_post')->name('website.contact.post');
    Route::post('bmi-calculator', 'App\Http\Controllers\Website\HomeController@bmi_calculator_post')->name('website.bmiCalculator.post');
    Route::post('add_hotspot', 'App\Http\Controllers\Website\HomeController@add_hotspot')->name('website.add_hotspot');

});