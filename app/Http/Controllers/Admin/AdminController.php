<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\tbl_otp;
use App\Models\Userdevice;
use App\Models\Admin;
use Illuminate\Support\Facades\Cookie;
use Artisan;
use Auth;
use Hash;

class AdminController extends Controller
{
    public function login(){
        if (Auth::guard('admin')->check()) {
             // dd(session('user'));
             // return redirect(route('admin.home'));
            return redirect()->back();
        }
        return view('admin.auth.login');
    }

    // public function register(){
    //     return view('admin.auth.register');
    // }
    
    // public function otp_verification(){
    //     return view('admin.auth.otp_verification');
    // }
   
    // public function otp_verification_post(Request $request){
    //     $this->validate($request,[
    //         'otp_code' => 'required',
    //     ]);
    //     $user = User::where(['email' => $request->email])->first();
    //     if($user->otp_code !== $request->otp_code){
    //         return redirect()->back()->withInput()->withErrors(['otp_code' => 'Please Enter Valid Otp Code']);
    //     }
    //     $user->update(['otp_code' => '', 'verify' => 'verified']);
    //     \Session::forget('user_email');
    //     // dd($user);
    //     return redirect(route('admin.home'));
    // }

    public function login_post(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // \DB::beginTransaction();
        $result = Admin::where(['email' => $request->email])->select('*')
        ->first();
        if(empty($result)){
            \Session::flash('error',"User Not Found");
            return redirect(route('admin.login'));
            // return $this->toJson([],trans('api.auth.user_not_availbale'),0);
        }
        if(\Hash::check($request->password, $result->password)){
            $credential = request(['email','password']);
            Auth::guard ('admin')->attempt($credential);
                // \DB::commit();
                Cookie::queue('admin_email', "", 3600);
                Cookie::queue('admin_password', "", 3600);
                if(!empty($request->remember)){
                Cookie::queue('admin_email', $request->email, 3600);
                Cookie::queue('admin_password', $request->password, 3600);
                }
              \Session::flash('success',"Login Successfully");
              return redirect(route('admin.home'));
            
        }
        \Session::flash('error',"Password Was Worng Please Try Again Later");
        return redirect(route('admin.login'));
        // ->with('success',"Login Suceess");
    }

    // public function register_post(Request $request){
    //     $this->validate($request,[
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'profile_image' => 'required',
    //         'email' => 'required|email|unique:tbl_user,email',
    //         'country_code' => 'required',
    //         'phone' => 'required|min:8',
    //         'password' => 'required|confirmed',
    //         'gender' => 'required'
    //     ]);
    //     \DB::beginTransaction();
    //     $checkphone = User::where(['phone' => $request->phone])->first();
       
    //     if(!empty($checkphone)){
    //         // return $this->toJsonEnc([''],trans('api.auth.already_exist_phone'),0);
    //         return redirect()->back()->withInput()->withErrors(['phone' => 'Phone number already exists']);
    //     }
    //     $randomNumber = rand(1000, 9999);
    //     $userDetail = new User();
    //     // dd($request->all());
    //     $fileName = time().'.'.$request->file('profile_image')->getClientOriginalExtension();
    //     // $request->file('profile_image')->storeAs('public/profile_image',$fileName);
    //     $request->profile_image->move(public_path('/uploads/profile_image'), $fileName);
    //     $data = $request->all();
    //     $data['profile_image'] = $fileName;
    //     $userDetail->fill($data);
    //     $userDetail->password = bcrypt($request->password);
    //     $userDetail->otp_code = $randomNumber;
    //     if($userDetail->save()){
    //         \DB:: commit();
    //         session()->put('user_email', $userDetail->email);
    //         Artisan::call('command:sendWelcomeMail '.$userDetail->id);
    //         // return $this->toJsonEnc([''],trans('api.auth.succ_signup'),1);
    //         // \Session::flash('error',"Password Was Worng Please Try Again Later");
    //         return redirect(route('admin.otp_verification'));
    //     }
    // }

    public function logout(){
        Auth::guard('admin')->logout();
        session()->forget('user');
        return redirect(route('admin.home'));
    }

}
