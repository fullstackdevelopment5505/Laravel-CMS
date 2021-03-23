<?php

namespace App\Http\Controllers;
use Validator,Redirect,Response;
use Illuminate\Http\Request;
use App\User;
use App\Configuration;
use App\Category;
use Shipu\Themevel\Facades\Theme;
use Illuminate\Support\Facades\Storage;
use App\GlobalConfig;


class SuperAdminAppearanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:SUPER_ADMIN');
        GlobalConfig::adminSession();
    }

    public function index()
    {
        $current_theme = Configuration::where('config_title', '=','ACTIVE_THEME')->first();
       
        $themes = Theme::all();
        $theme_detail = array();
        foreach ($themes as $theme) {
            $themeInfo = Theme::getThemeInfo($theme['name']);
            $path = $themeInfo['path'].'/theme.json';
            $json = json_decode(file_get_contents($path), true);
            $json['current_theme'] = 0;
            if($current_theme['config_value'] == $theme['name']){
                $json['current_theme'] = 1;
            }
            array_push($theme_detail, $json);
        }
        return view('admin/appearance',['themes'=> $theme_detail]);
    }

    public function themeApply(Request $request)
    { 
        $data = $request->all();
        $current_theme = Configuration::where('config_title', '=','ACTIVE_THEME')->first();
        $current_theme->update([
            'config_value' => $data['theme']
        ]);
        return Redirect::to('/textla/appearance')->with('status','Theme Set successfully');
    }

   
    
    
}
