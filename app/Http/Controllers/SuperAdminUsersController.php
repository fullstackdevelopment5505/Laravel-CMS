<?php

namespace App\Http\Controllers;
use Validator,Redirect,Response;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\VerifyUser;
use App\Mail\UserRoll;
use App\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;use App\GlobalConfig;
use Illuminate\Support\Collection;
class SuperAdminUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:SUPER_ADMIN');GlobalConfig::adminSession();
    }

    public function index(Request $request)
    {
        $sort_by = $request->get('sortby');
        $sort_type = $request->get('sorttype');
        $query = $request->get('query');
        if($request->ajax()){
            $users = User::select('users.*')->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles',function ($join) {
                $join->on('roles.id', '=', 'role_user.role_id')->where('roles.name', 'CUSTOMER');
            });
            if(isset($query)){
                $users = $users->where('users.fullname', 'like', '%'.$query.'%')
                ->orWhere('email', 'like', '%'.$query.'%')
                ->orWhere('country', 'like', '%'.$query.'%');
            }            
            $users = $users->orderBy($sort_by, $sort_type)->paginate(10);
            return view('admin.part.customer_pagination', compact('users'));
        }else{
            $users = User::select('users.*')->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.name', 'USER');
            $users = $users->orderBy('created_at', 'desc')->paginate(10);
            return view('admin/customer', compact('users')); 
        }
    }

    public function viewProfile(Request $request){

        if($request->ajax()){
            if ($request->has('id')) {
                $userId = $request->get('id');
                $user = User::where('id', $userId)->first();
                return view('admin.part.user_profile', compact('user'));
            }
        }
        return view('admin.part.user_profile');
    }
    public function user(Request $request){
        $sort_by = $request->get('sortby');
        $sort_type = $request->get('sorttype');
        $query = $request->get('query');
        if($request->ajax()){
            $users = User::leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->select('users.*','roles.name')
            ->where('roles.default', '0');
            if(isset($query)){
                $users = $users->where('fullname', 'like', '%'.$query.'%')
                ->orWhere('email', 'like', '%'.$query.'%');
            }            
            $users = $users->orderBy($sort_by, $sort_type)->paginate(10);
            return view('admin.part.user_pagination', compact('users'));            
        }else{
            $users = User::leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->select('users.*','roles.name')
            ->where('roles.default', '0')->orderBy('created_at', 'desc')->paginate(10);
            return view('admin.user',['users'=>$users]);
        }
        return view('admin.user');
    }
    public function usercreate(Request $request){
        $userRole = Role::where('default', '0')->get();
        return view('admin.usercreate',['roles'=>$userRole]);
    }
    public function userEdit(Request $request){
        $roles =Role::where('default', '0')->get();
        $user = User::where('id', $request->get('id'))->first();
        
        if($request->ajax()){
            if ($request->has('id')) {
                $userId = $request->get('id');  
                $modules = Module::get(); 
                $user = User::leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
                ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
                ->select('users.*','roles.*')
                ->where('users.id', $userId)
                ->first();               
                return view('admin.part.users_profile', compact('user','modules'));
            }
        }        
        return view('admin/userupdate',['user'=>$user,'roles'=>$roles]);
    }
    public function userUpdate(Request $request)
    {   
         $data = $request->all();      
         $id = $data['id'];  
         $user = User::where('id', $id)->first();
         $user->update([
            'email'=>$request->get('email'),            
            'fullname'=>$request->get('fullname'),
            'mobile'=>$request->get('mobile')
         ]); 
        return Redirect::to('/textla/user')->with('status','User Update Successfully.');
        
    }
    public function userAdd(Request $request)
    {           
       $email= $request->get('email');
        $pass= Str::random(8);  
        $Password = Hash::make($pass);       
        $user = User::where('email','=', $email)->first();
        if ($user) {           
            return Redirect::to('/textla/usercreate')->with('error','You have allready set Role this User');
            
        }
        $user = User::create([
            'email'=>$email,
            'password'=>$Password,
            'fullname'=>$request->get('fullname'),
            'mobile'=>$request->get('mobile')
        ]);           
        $user->roles()->attach(Role::where('name', $request->get('userroll'))->first());
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time())
        ]);
        $user['fullname'] = $request->get('fullname');
        $user['mobile'] = $request->get('mobile');
        $user['password'] = $pass;
        $user['roll'] = $request->get('userroll');
        Mail::to($user->email)->send(new UserRoll($user));
        $user = User::where('email','=', $email)->first();
        if ($user) {           
            return Redirect::to('/textla/usercreate')->with('status','sent you an activation link on User email. Check email and click on the link Active Acccount.');
        }  

        return view('admin.usercreate');
    }
    public function role(Request $request){        
        $sort_by = $request->get('sortby');
        $sort_type = $request->get('sorttype');
        $query = $request->get('query');
        if($request->ajax()){
            $roles = Role::where('default','0');
            if(isset($query)){
                $roles = $roles->where('name', 'like', '%'.$query.'%')
                ->orWhere('description', 'like', '%'.$query.'%');
            }            
            $roles = $roles->orderBy($sort_by, $sort_type)->paginate(10);
            return view('admin.part.role_pagination', compact('roles'));
        }else{
            $userRole = Role::where('default','0')->orderBy('created_at', 'desc')->paginate(10);
            return view('admin.role',['roles'=>$userRole]);
        }

       
    }

    public function roleAdd(Request $request)
    {   
        $role = Role::create([            
            'name'=>$request->get('rolename'),
            'description'=>$request->get('roledescription'),
            'permissions'=>$request->get('permissions')
        ]);  
        return Redirect::to('/textla/role')->with('status','Role Added Successfully.');
    }
    public function rolecreate(Request $request)
    {   
        $modules = Module::get();
        return view('admin/role/rolecreate',['modules'=> $modules]);
        
    }
    public function roleEdit(Request $request)
    {           
        $role = Role::where('id', $request->get('id'))->first();
        $modules = Module::get();
        if($request->ajax()){
            if ($request->has('id')) {
                $roleId = $request->get('id');
                $role = Role::where('id',$roleId)->first();
                $user = User::leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
                ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
                ->select('users.*','roles.name')
                ->where('roles.id', $roleId)
                ->get();    
                return view('admin.part.role_detail', compact('role','modules','user'));
            }
        }
        return view('admin/role/roleupdate',['role'=>$role, 'modules'=>$modules]);        
    }
    public function roleUpdate(Request $request)
    {   
        $data = $request->all();      
        $id = $data['id'];
        $name = $data['rolename'];
        $description = $data['roledescription'];
        $role = Role::where('id', $id)->first();
        $role->update([
            'name'=> $name,
            'description'=> $description,
            'permissions'=>$request->get('permissions')
        ]);
        return Redirect::to('/textla/role')->with('status','Roll Update Successfully.');
        
    }
    public function roleDelete(Request $request)
    {   
        $id = $request->query('id');       
        $role = Role::where('id', '=', $id)->delete();             
        return Redirect::to('/textla/role')->with('status','Roll Delete Successfully.');
        
    }
    public function userDelete(Request $request)
    {   
        $id = $request->query('id');       
        $role = User::where('id', '=', $id)->delete();             
        return Redirect::to('/textla/role')->with('status','User Delete Successfully.');
        
    }
    public function adminProfile(Request $request)
    {   
        $admin = User::where('id', Auth::user()->id)->first();                    
        return view('admin.adminprofile',['admin'=>$admin]);
        
    }
    public function adminProfileUpdate(Request $request)
    {   
        $admin = User::where('id', Auth::user()->id)->first();
        $admin->update([
            'email'=>$request->get('email'),            
            'fullname'=>$request->get('fullname'),
            'mobile'=>$request->get('mobile')
         ]); 
        return Redirect::to('/textla/adminprofile')->with('status','Profile Update Successfully.');
                
    }
    public function adminChangePassword(Request $request)
    {   
        $oldpass= $request->get('oldpassword');
        $newpass= $request->get('newpassword');     
        $PasswordOld = Hash::make($oldpass);
        $PasswordNew = Hash::make($newpass);        
        $user = User::where('id','=', Auth::user()->id)->first(); 
        $cryptedpassword = $user['password'];
        if(Hash::check($oldpass,$cryptedpassword)) {
            // Right password
            $user->update([
                'password'=> $PasswordNew
                ]);
            return Redirect::to('/textla/adminprofile')->with('status','Your Password change Successfully');
        } else {
            // Wrong one
            return Redirect::to('/textla/adminprofile')->with('error','Your Password not match');
        }         
                
    }
}
