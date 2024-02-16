<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\tbl_otp;
use App\Models\Userdevice;
use App\Models\contact_us;
use App\Helpers\ApiHelper;
use Illuminate\Support\Facades\Cookie;
use Artisan;
use Auth;
use Hash;

class AuthController extends Controller
{
    //
    public function login(){
        \Log::debug(auth()->user());
        if(auth()->user()){
            // dd(session('user'));
            // return redirect(route('admin.home'));
            return redirect()->back();
        }

       return view('website.auth.login');
    }

    public function login_post(Request $request){
        // dd($request->all());
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        \DB::beginTransaction();
        $result = User::where(['email' => $request->email])->select('id','first_name','last_name','profile_image','password','email','country_code','phone', 'gender','verify')
        ->first();
        if(empty($result)){
            return redirect()->back()->withInput()->withErrors(['email' => 'User Not Exists']);
        }
        
        if(\Hash::check($request->password, $result->password)){
            if($result->verify == "pending"){
                $randomNumber = rand(1000, 9999);
                $user = User::where(['email' => $request->email])->first();
                $user->update(['otp_code' => $randomNumber]);
                \DB::commit();
                Artisan::call('command:sendWelcomeMail '.$result->id);           
                session()->put('user_email', $result->email);
                return redirect(route('website.otp_verification'));
            }
            $credential = request(['email','password']);
            Auth::attempt($credential);
            
            $accessToken = $result->createToken('first_laravel')->accessToken;
            Userdevice::where(['user_id'=>$result->id])->delete();
            $tokendata = Userdevice::create(['token'=>$accessToken,'user_id'=>$result->id]);

            if($tokendata == true){
                \DB::commit();
                // Cookie::forget('email');
                // Cookie::forget('password');
                Cookie::queue('email', "", 3600);
                Cookie::queue('password', "", 3600);
                session()->put('user', $result);
                \Session::flash('success',"Login Successfully");
                return redirect(route('website.home'));
            }      
        }
        return redirect()->back()->withInput()->withErrors(['password' => 'Password Was Worng Please Try Again Later']);
    }

    public function otp_verification(){
        if(auth()->user()){
            return redirect()->back();
        }
        return view('website.auth.otp_verification');
    }
   
    public function otp_verification_post(Request $request){
        $this->validate($request,[
            'otp1' => 'required|max:1',
            'otp2' => 'required|max:1',
            'otp3' => 'required|max:1',
            'otp4' => 'required|max:1',
        ]);
        $otp_code = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4;
        $user = User::where(['email' => $request->email])->first();
        if($user->otp_code !== $otp_code){
            return redirect()->back()->withInput()->withErrors(['otp_code' => 'Please Enter Valid Otp Code']);
        }
        $user->update(['otp_code' => '', 'verify' => 'verified']);
        \Session::forget('user_email');
        // dd($user);
        return redirect(route('website.home'));
    }

    public function signup(){
        if(auth()->user()){
            return redirect()->back();
        }
        if(auth()->user()){
            // dd(session('user'));
            // return redirect(route('admin.home'));
            return redirect()->back();
        }

        return view('website.auth.signup');
    }

    public function signup_post(Request $request){
        dd($request->file('profile_image'));
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'profile_image' => 'required',
            'email' => 'required|email|unique:tbl_user,email',
            'country_code' => 'required',
            'phone' => 'required|min:8',
            'password' => 'required|confirmed',
            'gender' => 'required'
        ]);
        \DB::beginTransaction();
        $checkphone = User::where(['phone' => $request->phone])->first();
       
        if(!empty($checkphone)){
            // return $this->toJsonEnc([''],trans('api.auth.already_exist_phone'),0);
            return redirect()->back()->withInput()->withErrors(['phone' => 'Phone number already exists']);
        }
        $randomNumber = rand(1000, 9999);
        $userDetail = new User();
        // dd($request->all());
        $fileName = time().'.'.$request->file('profile_image')->getClientOriginalExtension();
        // $request->file('profile_image')->storeAs('public/profile_image',$fileName);
        $request->profile_image->move(public_path('/uploads/profile_image'), $fileName);
        $data = $request->all();
        $data['profile_image'] = $fileName;
        $userDetail->fill($data);
        $userDetail->password = bcrypt($request->password);
        $userDetail->otp_code = $randomNumber;
        if($userDetail->save()){
            \DB:: commit();
            session()->put('user_email', $userDetail->email);
            Artisan::call('command:sendWelcomeMail '.$userDetail->id);
            // return $this->toJsonEnc([''],trans('api.auth.succ_signup'),1);
            // \Session::flash('error',"Password Was Worng Please Try Again Later");
            return redirect(route('website.otp_verification'));
        }
    }

    public function logout(){
        Auth::logout();
        session()->forget('user');
        return redirect(route('website.login'));
    }

    public function contact_us(Request $request){
        $cartDetails = ApiHelper::getCartDeatils($request);
        $cart = $cartDetails['cart'];
        $cart_count = $cartDetails['cart_count'];
        return view('website.product.contact_us',compact('cart','cart_count'));
    }

    public function contact_us_post(Request $request){
        $this->validate($request,[
            'title' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);
        $data = [
            'title' => $request->title,
            'email' => $request->email,
            'message' => $request->message
        ];
        $contact = contact_us::create($data);
        dd($contact);
        if (!$contact) {
           return redirect()->route('error')->with('error', 'Data insertion failed'); 
        } 
        \Session::flash('success',"Successfully Save Your Data Please Wait For Response");
        return view('website.product.contact_us');
    }
}
