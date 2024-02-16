<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use Illuminate\Support\Facades\Session;
use App\Helpers\EncryptDecrypt;

class HomeController extends Controller
{
    public function home_page(Request $request){
        if (!Session::has('user')) {  
            return redirect()->back();
        }
        $response = ApiHelper::apicall("user/homescreen_feed","POST",array());
        if($response->code){
            $data = $response->data;
            return view('website.home.newsfeed',compact('data'));
        }else{
            return view('website.home.newsfeed');
        }
    }  
}
