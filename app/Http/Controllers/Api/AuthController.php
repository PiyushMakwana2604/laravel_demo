<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\tbl_otp;
use App\Models\Userdevice;
use Artisan;
use Auth;
use Hash;



class AuthController extends Controller
{
    public function signup(Request $request){
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'profile_image' => 'required',
            'email' => 'required|email|unique:tbl_user,email',
            'country_code' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'gender' => 'required'
        ]);
        \DB::beginTransaction();
        $checkphone = User::where(['phone' => $request->phone])->first();
       
        if(!empty($checkphone)){
            return $this->toJsonEnc([''],trans('api.auth.already_exist_phone'),0);
        }
        
        $userDetail = new User();
        $userDetail->fill($request->all());
        $userDetail->password = bcrypt($request->password);
        if($userDetail->save()){
            \DB:: commit();
            Artisan::call('command:sendWelcomeMail '.$userDetail->id);
            return $this->toJsonEnc([''],trans('api.auth.succ_signup'),1);
        }
        return $this->toJsonEnc([''],trans('api.auth.somthing_wrong'),0);        
    }

    public function login(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // dd($request->all());
        \DB::beginTransaction();
        $result = User::where(['email' => $request->email])->select('id','first_name','last_name','profile_image','password','email','country_code','phone', 'gender')
        ->first();
        if(empty($result)){
            return $this->toJsonEnc([''],trans('api.auth.user_not_availbale'),0);
        }
        if(Hash::check($request->password, $result->password)){
            $credential = request(['email','password']);
            Auth::attempt($credential);
          
            $accessToken = $result->createToken('first_laravel')->accessToken;
            $tokendata = Userdevice::create(['token'=>$accessToken,'user_id'=>$result->id]);

           if($tokendata == true){
              \DB::commit();
                return $this->toJson([
                    'userdetails' => $result,
                    'access_token' => $accessToken
                ],trans('api.auth.logged'),1);
            }      
        }
        return $this->toJsonEnc([''],trans('api.auth.password_not_match'),0);
    }

    public function logout(Request $request){
        $user = Auth::guard('api')->user();
        $userToken = Auth::user()->token();
        // dd($userToken);
        if(empty($user)){
            return $this->toJsonEnc([],trans('api.auth.not_found'),0);
        }
        userdevice::where(['user_id'=>$user->id])->delete();

        $userToken->revoke();

        \Session::flush();

        return $this->toJsonEnc([],trans('api.auth.logout_success'),1);
    }

    public function otp(Request $request){
        $this->validate($request,[
            'phone' => 'required',
        ]);
        $otp = rand(1000,9999);

        $send_otp = tbl_otp::where('phone','=',$request->phone)->delete();
        $send_otp = tbl_otp::Create(['phone'=>$request->phone,'otp'=>$otp]);
        
        if ($send_otp == true) {
            return $this->toJsonEnc(['',trans('api.auth.otp_success'),1]);
        } else {
            return $this->toJsonEnc(['',trans('api.auth.somthing_wrong'),0]);

        }
    }
    
    public function otp_verify(Request $request){
        $this->validate($request,[
            'phone' => 'required',
            'otp' => 'required',
        ]);
        $result = tbl_otp::where(['phone' => $request->phone])->first();
        if($result){
            if($result->otp !== $request->otp){
                return $this->toJsonEnc(['',trans('api.auth.enter_valid_otp'),0]);
            }
             $result->update(['is_verify' => 1,'otp' => ""]);
            return $this->toJsonEnc(['',trans('api.auth.otp_verify_success'),1]);
        }else{
            return $this->toJsonEnc(['',trans('api.auth.enter_valid_phone'),0]);
        }
    }

    public function view_profile(Request $request){
        $user = $request->user();
        if($user){
            return $this->toJsonEnc([$user,trans('api.auth.succ_get_profile_details'),1]);
        }
        return $this->toJsonEnc(['',trans('api.auth.cannot_get_profile_details'),0]);
    }

    public function change_pass(Request $request){
        $user = $request->user();
         $this->validate($request,[
            'current_pass' => 'required',
            'new_pass' => 'required',
        ]);
        if(!Hash::check($request->current_pass, $user->password)){
            return $this->toJsonEnc(['',trans('api.auth.password_not_match'),0]);
        }
               $user->update(['password' => Hash::make($request->new_pass)]);
        // $user->password = Hash::make($request->new_pass);
        // $user->save();

        return $this->toJsonEnc(['',trans('api.auth.succ_change_pass'),1]);
    }
}
