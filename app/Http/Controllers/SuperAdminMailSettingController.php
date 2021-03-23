<?php

namespace App\Http\Controllers;
use Validator,Redirect,Response;
use Illuminate\Http\Request;
use App\User;
use App\Configuration;

use Illuminate\Support\Facades\Storage;use App\GlobalConfig;
class SuperAdminMailSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:SUPER_ADMIN');GlobalConfig::adminSession();
    }

    public function index()
    {
        $configuration = Configuration::get();
        $data = array();
        foreach ($configuration as $config) {
            if($config['config_title']=='SMTP_PORT'){
                $data['smtp_port']=$config['config_value'];
            }else if($config['config_title']=='SMTP_HOST'){
                $data['smtp_host']=$config['config_value'];
            }else if($config['config_title']=='SMTP_USER'){
                $data['smtp_user']=$config['config_value'];
            }else if($config['config_title']=='SMPT_PASSWORD'){
                $data['smtp_password']=$config['config_value'];
            }
        }
        return view('admin/mailsetting',['configuration'=>$data]);
    }

    public function updateSetting(Request $request)
    {
        $data = $request->all();
        Configuration::where('config_title', '=', 'SMTP_PORT')->update([
            'config_value' => $data['smtp_port']
        ]);
        Configuration::where('config_title', '=', 'SMTP_HOST')->update([
            'config_value' => $data['smtp_host']
        ]);
        Configuration::where('config_title', '=', 'SMTP_USER')->update([
            'config_value' => $data['smtp_user']
        ]);
        Configuration::where('config_title', '=', 'SMPT_PASSWORD')->update([
            'config_value' => $data['smtp_password']
        ]);
        return Redirect::to('/textla/mailsetting')->with('status','Mail setting updated successfully');
    }       
    
    
}
