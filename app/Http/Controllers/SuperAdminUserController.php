<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class SuperAdminUserController extends Controller
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
            echo 'fun call';
            $users = User::select('users.*')->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles',function ($join) {
                $join->on('roles.id', '=', 'role_user.role_id')->where('roles.name', 'USER');
            });
            if(isset($query)){
                $users = $users->where('users.memberid', 'like', '%'.$query.'%')
                ->orWhere('fullname', 'like', '%'.$query.'%')
                ->orWhere('email', 'like', '%'.$query.'%')
                ->orWhere('country', 'like', '%'.$query.'%');
            }            
            $users = $users->orderBy($sort_by, $sort_type)->paginate(10);
            return view('admin.part.user_pagination', compact('users'));
        }else{
            $users = User::select('users.*')->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('roles.name', 'USER');
            $users = $users->orderBy('created_at', 'desc')->paginate(10);
            return view('admin/users', compact('users')); 
        }
    }

    public function viewProfile(Request $request){
        if($request->ajax()){
            if ($request->has('userId')) {
                $userId = $request->input('userId');
                $user = User::where('id', $userId)->first();
                return view('admin.part.user_profile', compact('user'));
            }
        }
    }
}
