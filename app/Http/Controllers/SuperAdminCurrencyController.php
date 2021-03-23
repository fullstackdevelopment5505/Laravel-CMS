<?php

namespace App\Http\Controllers;
use Validator,Redirect,Response;
use App\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;use App\GlobalConfig;

class SuperAdminCurrencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:SUPER_ADMIN');GlobalConfig::adminSession();
    }

    public function index(Request $request)
    {
        $actived_currency = Configuration::where('config_title', '=','DEFAULT_CURRENCY')->first();
        $rusult = $actived_currency['config_value'];       
        
        $currencyType = Configuration::where('config_title', '=','DECIMAL_POINT')->first();
        $rusult1 = $currencyType['config_value'];       
             
        return view('admin/currency',['currency'=>$rusult,'currencyType'=>$rusult1]);  


    }  
    
    public function currencySet(Request $request)
    { 
        $data = $request->all();          
        $currency = Configuration::where('config_title', '=','DEFAULT_CURRENCY')->first();
        $currencyType = Configuration::where('config_title', '=','DECIMAL_POINT')->first();
        $currency->update([
           'config_value' => $data['currency']
        ]);    
        //1 is with decimal
        //0 is without decimal
        $currencyType->update([
           'config_value' => $data['currencyType']
        ]);    
        //return 'Currency Set successfully';   
       return Redirect::to('/textla/currency')->with('status','Currency Set successfully');
       
    }
    
}
    
  