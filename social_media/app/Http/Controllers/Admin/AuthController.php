<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Validator;
use App\Helpers\ApiHelper;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login(){
        return view('admin.auth.login');
    }

    public function login_post(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'            
        ]);
       
        $postInput = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $url = "auth/login";
        $method = 'POST';
        $token = "";

        $response = ApiHelper::api_common($postInput,$url,$method,$token);
        dd($response);
        return view('admin.auth.home');
    }
}
