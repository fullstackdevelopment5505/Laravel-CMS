<?php

namespace App\Http\Controllers;
use Validator,Redirect,Response;
use Illuminate\Http\Request;
use App\ContactDetail;
use Illuminate\Support\Facades\Storage;
use App\GlobalConfig;

class SuperAdminContactMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:SUPER_ADMIN');
        GlobalConfig::adminSession();
    }

    public function index(Request $request)
    {
        $sort_by = $request->get('sortby');
        $sort_type = $request->get('sorttype');
        $query = $request->get('query');
        if($request->ajax()){
            $messages = ContactDetail::select('contact_detail.*');
            if(isset($query)){
                $messages = $messages->where('contact_name', 'like', '%'.$query.'%')
                ->orWhere('contact_email', 'like', '%'.$query.'%')
                ->orWhere('message', 'like', '%'.$query.'%');
            }            
            $messages = $messages->orderBy($sort_by, $sort_type)->paginate(10);
            return view('admin.part.contact_message_pagination', compact('messages'));
        }else{
            $messages = ContactDetail::orderBy('created_at', 'desc')->paginate(10);
            return view('admin/contactMessage', compact('messages'));                    
           
        }
       
    }  
   
}
    
  