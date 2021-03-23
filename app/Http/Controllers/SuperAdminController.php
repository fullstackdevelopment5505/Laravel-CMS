<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use App\User;
use App\VerifyUser;
use App\Mail\VerifyMail;
use App\Mail\ForgotMail;
use App\Configuration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Session;
class SuperAdminController extends Controller
{
    public function index()
    {
        $logo = Configuration::where('config_title', '=','SITE_LOGO')->first();
        return view('admin.login',['logo'=>$logo['config_value']]);
    }
    public function logout() {
       Session::flush();
       Auth::logout();
       return Redirect::to('/textla/login');
   }
    public function postLogin(Request $request)
    {
       $role = 'SUPER_ADMIN';
       request()->validate([
       'email' => 'required',
       'password' => 'required',
       ]);
       $credentials = $request->only('email', 'password');
       if (Auth::attempt($credentials)) {
           $user = Auth::user();
           if (!$user->verified) {
               auth()->logout();
               return Redirect::back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
           }
           if(!$user->hasRole($role)){
               auth()->logout();
               return Redirect::back()->with('warning', 'You are unauthorised to access this panel.');
           }
           return Redirect::to('/textla/dashboard');
       }
        
       return Redirect::back()->withErrors('Oppes! You have entered invalid credentials');
    }
    
}
