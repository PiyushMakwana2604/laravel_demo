<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;
use App\Models\tbl_otp;
use App\Models\Userdevice;
use Artisan;
use Auth;
use Hash;

class UserController extends Controller
{
    //
    public function home(Request $request){
        if (!Auth::guard('admin')->check()) {
            # code...
            return redirect(route('admin.login'));
           
            // return redirect()->back();
        } else {
            # code...
            $name = "<h1><i>jasus</i></h1>";
            $array = ['name' => 'Piyush Makwana','phone' => '741859630' , 'age' => '45'];
            return view('home',compact('name','array'));

        }
        
        // dd(auth()->user());
       
    }
    
    public function list(){
        // dd("d",Auth::guard('admin')->check());
        if (!Auth::guard('admin')->check()) {
            return redirect(route('admin.login'));
        } else {
            // return redirect()->back();
            // return view('login');
            return view('admin.auth.list');
        }
      
    }
    
    public function get_userlist(){
        if (!Auth::guard('admin')->check()) {
            return redirect(route('admin.login'));
        } 
        $user = User::selectRaw('id,first_name,last_name,profile_image,phone,gender');

        return DataTables::of($user)
        ->addColumn('status',function ($row) {
            return "Active";
        })
        ->addColumn('action',function ($row) {
            return '
            <div style="display:flex;justify-content:center;">
                <button type="button" class="btn btn-info" style="margin-right: 2%;"><a style="color:aliceblue;" href="' . route('admin.edit-form', ['id' => $row->id]) . '">Edit</a></button>
                <button type="button" class="btn btn-danger"><a style="color:aliceblue;" href="' . route('admin.delete-user', ['id' => $row->id]) . '">Delete</a></button>
            </div>';
        })
        ->make(true);
    }

    public function edit_form(Request $request){
        if (!Auth::guard('admin')->check()) {
            return redirect(route('admin.login'));
        } 
        $id = $request->id;
        // $result = User::where(['id' => $request->id])->select('id','first_name','last_name','profile_image','email','country_code','phone', 'gender');
        $user = User::where(['id' => $request->id])->first();
        return view('admin.auth.edit_form',compact('user'));
    }

    public function edit_form_post(Request $request){
        if (!Auth::guard('admin')->check()) {
            return redirect(route('admin.login'));
        } 
         $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'profile_image' => 'nullable',
            'email' => 'required|email',
            'country_code' => 'required',
            'phone' => 'required',
            'gender' => 'required'
        ]);
        $checkemail = User::where(['email' => $request->email])->where('id','!=' ,$request->id)->first();
        $user = User::where(['id' => $request->id])->first();
       
        if(!empty($checkemail)){
            // return $this->toJsonEnc([''],trans('api.auth.already_exist_phone'),0);
            return redirect()->back()->withInput()->withErrors(['email' => 'Email Id already exists']);
        }

        if(isset($request->profile_image) && $request->profile_image != ""){
            $fileName = time().'.'.$request->file('profile_image')->getClientOriginalExtension();
            // $request->file('profile_image')->storeAs('public/profile_image',$fileName);
            $request->profile_image->move(public_path('/uploads/profile_image'), $fileName);
            $profile_image = $fileName;
        }else{
            $profile_image = $user->profile_image;
        }
        $update = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'profile_image' => $profile_image ,
            'email' => $request->email,
            'country_code' => $request->country_code,
            'phone' => $request->phone,
            'gender' => $request->gender
        ];
        $user->update($update);
        // dd($update);
        $id = $request->id;
        // $result = User::where(['id' => $request->id])->select('id','first_name','last_name','profile_image','email','country_code','phone', 'gender');
        return redirect(route('admin.list'));
    }

    public function delete_user(Request $request){
        if (!Auth::guard('admin')->check()) {
            return redirect(route('admin.login'));
        } 
        // dd($request->id);
        $user = User::where('id',$request->id)->delete();
        // if(empty($user)){
            
        // }
        return redirect(route('admin.list'));

    }
}
