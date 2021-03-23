<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use App\User;
use App\Role;
use App\VerifyUser;
use App\Mail\VerifyMail;
use App\Mail\ForgotMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Session;

class AuthController extends Controller
{
    
    public function index()
    {
        return view('login');
    }
    public function registration()
    {
        return view('register');
    }
    public function forgotPassword(){
        return view('forgotpassword');
    }
    public function postLogin(Request $request)
    {

        $role = 'USER';
        request()->validate([
        'email' => 'required',
        'password' => 'required',
        ]);
       $credentials = $request->only('email', 'password');
       dd($credentials);
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
           return redirect()->intended('dashboard');
       }
        
       return Redirect::back()->withErrors('Oppes! You have entered invalid credentials');
    }
    public function postRegistration(Request $request)
    {
       request()->validate([
           'country' => 'required',
           'name' => 'required',
           'email' => 'required|email|unique:users',
           'password' => 'required|min:6',
           'terms' => 'required'
       ]);
       $data = $request->all();
       $user = $this->create($data);
       $user->roles()->attach(Role::where('name', 'USER')->first());
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time())
        ]);
        Mail::to($user->email)->send(new VerifyMail($user));
       return Redirect::to("register")->withSuccess('We sent you an activation code. Check your email and click on the link to verify.');
    }
    public function postForgotPassword(Request $request)
    {
       request()->validate([
           'email' => 'required|email'
       ]);
        $data = $request->all();
        $user = User::where('email', $data['email'])->first();
        if(isset($user) ){
            $password = time();
            $user->password = Hash::make($password);
            $user->save();
            $tmpUser = $user;
            $tmpUser->password =$password;
            Mail::to($user->email)->send(new ForgotMail($tmpUser));
            return redirect('/login')->with('status', "We sent you temporary password on your register email id. Check your email and login with new password.");
        }else{
           return redirect('/forgot-password')->with('warning', "Sorry your email cannot be identified.");
        }
    }
    public function create(array $data)
    {
        $member_unique_id = User::get_last_member_id();
      return User::create([
        'memberid'=>$member_unique_id,
        'fullname' => $data['name'],
        'email' => $data['email'],
        'country'=>$data['country'],
        'status'=>'1',
        'password' => Hash::make($data['password'])
      ]);
    }
    
    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now login.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }

        return redirect('/login')->with('status', $status);
    }
    
    public function logout() {
       Session::flush();
       Auth::logout();
       return Redirect::to('/login');
   }

}
