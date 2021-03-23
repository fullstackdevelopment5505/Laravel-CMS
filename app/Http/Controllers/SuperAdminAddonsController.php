<?php

namespace App\Http\Controllers;
use Validator,Redirect,Response;
use App\Configuration;
use Illuminate\Http\Request;
use App\Addon;
use Illuminate\Support\Facades\Storage;
use App\GlobalConfig;

class SuperAdminAddonsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:SUPER_ADMIN');
        GlobalConfig::adminSession();
    }

    public function index(Request $request)
    {
        $addons = Addon::get();
        return view('admin/add-ons', ['addons'=>$addons]);  
    }   
    public function activate(Request $request)
    {
        $id = $request->get("id");
        $status = $request->get("value");
        $addons = Addon::where('id', $id)->first();
        $addons->update([
            'status'=>$status
        ]);        
        return Redirect::to('/textla/add-ons')->with('status','Remove Product Deal Of The Week successfully');
    } 
    
    
    
}
    
  