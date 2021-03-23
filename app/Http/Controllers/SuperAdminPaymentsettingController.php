<?php

namespace App\Http\Controllers;
use Validator,Redirect,Response;
use App\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;use App\GlobalConfig;

class SuperAdminPaymentsettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:SUPER_ADMIN');GlobalConfig::adminSession();
    }

    public function index(Request $request)
    {
            
        return view('admin/paymentsetting');  


    }      
    
    
}
    
  