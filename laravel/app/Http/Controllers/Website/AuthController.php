<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use Illuminate\Support\Facades\Session;
use Auth;

class AuthController extends Controller
{
    //
    public function login(){
        if (Session::has('user')) {  
            return redirect()->back();
        }
        return view('website.auth.login');
    }
    
    public function login_post(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $postdata = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $url = "auth/login";
        $method = 'POST';
        $token = "";
        $response = ApiHelper::apicall($url,$method,$postdata);
        if($response->code == 1){
            $user = $response->data;
            session()->put('user', $user);
            // $userArray = json_decode(json_encode($user), true);
            return redirect(route('website.home-page'));
        }else{
            return redirect()->back()->withInput()->withErrors(['password' => $response->message]);
        }

    }
    
    public function signup(){
        if (Session::has('user')) {  
            return redirect()->back();
        }
        return view('website.auth.signup');
    }

    public function signup_post(Request $request){
        $this->validate($request,[
            'full_name' => 'required',
            'mobile_number' => 'required|min:10',
            'email' => 'required|email|unique:tbl_user,email',
            'password' => 'required|min:6',
            'office_city' => 'required',
            'office_state' => 'required',
            'office_address' => 'required',
            'office_phone_no' => 'required',
            'study' => 'required',
            'organization' => 'required',
        ]); 
        $postdata = [
            'full_name' => $request->full_name,
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'password' => $request->password,
            'office_city' => $request->office_city,
            'office_state' => $request->office_state,
            'office_address' => $request->office_address,
            'office_phone_no' => $request->office_phone_no,
            'study' => $request->study,
            'organization' => $request->organization
        ];
        $url = "auth/signup";
        $method = 'POST';
        $token = "";
        $response = ApiHelper::apicall($url,$method,$postdata); 
        if($response->code == "1"){
            session()->put('user', $response->user);
            return redirect(route('website.home-page'));
        }else{
            return redirect()->back()->withInput()->withErrors(['email' => $response->message]);
        }
    }

    public function validate_user(){
        if (Session::has('user')) {  
            return redirect()->back();
        }
        return view('website.auth.validate_user');
    }

    public function validate_post(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
        ]);
        $postdata = [
            'email' => $request->email
        ];
        $url = "auth/validateuser";
        $method = 'POST';
        $token = "";
        $response = ApiHelper::apicall($url,$method,$postdata);        
        if($response->code == "1"){
            session()->put('validate-email', $request->email);  
            session()->put('validate-otp_code', $response->data->otp_code);  
            return redirect(route('website.otp-verification'));
        }else{
            return redirect()->back()->withInput()->withErrors(['email' => $response->message]);
        }
    }
    
    public function otp_verification(){
        if (Session::has('user')) {  
            return redirect()->back();
        }
        return view('website.auth.otp_verification');
    }
    
    public function otp_verification_post(Request $request){
        $this->validate($request,[
            'otp_code' => 'required',
        ]);
        if(intval($request->otp_code) != session('validate-otp_code')){
            return redirect()->back()->withInput()->withErrors(['otp_code' => "Plase Enter Valid Otp Code"]);
        }
        return redirect(route('website.signup'));
    }
    
    public function logout(){
        Session::forget('user');
        // $token = Session::get('user')->token;

        // dd($token);
        // $url = "auth/validateuser";
        // $method = 'POST';
        // $token = "";
        // $response = ApiHelper::apicall($url,$method,$postdata);        
        return redirect(route('website.login'));
    }
}
