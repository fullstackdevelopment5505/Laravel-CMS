<?php

namespace App\Http\Controllers;
use Validator,Redirect,Response;
use Illuminate\Http\Request;
use App\User;
use App\Configuration;
use Illuminate\Support\Facades\Storage;use App\GlobalConfig;
class SuperAdminGeneralSettingController extends Controller
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
            if($config['config_title']=='SITE_TITLE'){
                $data['site_title']=$config['config_value'];
            }else if($config['config_title']=='SITE_LOGO'){
                $data['site_logo']=$config['config_value'];
            }else if($config['config_title']=='SITE_ADDRESS'){
                $data['site_address']=$config['config_value'];
            }else if($config['config_title']=='ADMINISTRATOR_EMAIL'){
                $data['administrator_email']=$config['config_value'];
            }else if($config['config_title']=='TIMEZONE'){
                $data['timezone']=$config['config_value'];
            }else if($config['config_title']=='TAGLINE'){
                $data['site_tagline']=$config['config_value'];
            }
        }
        return view('admin/generalsetting', ['configuration'=>$data]);
    }
       
    public function updateSetting(Request $request)
    {
        $data = $request->all();
        $fileName = $data['site_logo'];
        if ($request->hasFile('site_logo_file')) {
            Storage::delete($data['site_logo']);
            $fileName = time().'.'.$request->file('site_logo_file')->extension();  
            $request->file('site_logo_file')->move(public_path('media'), $fileName);  
            $fileName = 'media/'.$fileName;  
            Configuration::where('config_title', '=', 'SITE_LOGO')->update([
                'config_value' => $fileName
            ]);
        }
        Configuration::where('config_title', '=', 'SITE_TITLE')->update([
            'config_value' => $data['site_title']
        ]);
        Configuration::where('config_title', '=', 'SITE_ADDRESS')->update([
            'config_value' => $data['site_address']
        ]);
        Configuration::where('config_title', '=', 'ADMINISTRATOR_EMAIL')->update([
            'config_value' => $data['administrator_email']
        ]);
        Configuration::where('config_title', '=', 'TAGLINE')->update([
            'config_value' => $data['site_tagline']
        ]);
        return Redirect::to('/textla/generalsetting')->with('status','General setting updated successfully');
    }  
    
    
}
