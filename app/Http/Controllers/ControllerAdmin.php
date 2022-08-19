<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ControllerAdmin extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:tbl_user',
            'password' => 'required|min:3|max:10|confirmed',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);
        $admin = new Admin;
        $admin->user_name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $file_name = time().'.'.$extension;
            $request->image->move(public_path('assets/img/upload/admin_image'), $file_name);
            $admin->user_image = $file_name;
        }
        $save = $admin->save();
        if($save){
            return back()->with('success','User Successfully Created');
        }else{
            return back()->with('fail','Fail To Created User');
        }
    }
    public function login(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3|max:10'
        ]);
        $userInfo = Admin::where('email','=',$request->email)->first();
        if(!$userInfo){
            return back()->with('unrecognized','We do not recognized your email address');
        }else{
            if(Hash::check($request->password,$userInfo->password)){
                $request->session()->put('LoggedUser',$userInfo);
                return redirect(route('home'));
            }else{
                return back()->with('wrong_password','You enter wrong password');
            }
        }
    }
    public function logout(){
        if(session()->has('LoggedUser')){
            session()->pull('LoggedUser');
            return redirect(route('admin.login'));
        }
    }
}
