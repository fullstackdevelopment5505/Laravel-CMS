<?php

namespace App;
use App\Configuration;
use App\Category;
use App\Cart;
use App\Wishlist;
use App\Product;
use App\Page;
use App\Addon;
use Shipu\Themevel\Facades\Theme;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;

class GlobalConfig
{
    public static function currentThemeApply(Request $request)
    {
        $js_files  = [
            '/public/common.js'
        ];
        $current_theme = Configuration::where('config_title', '=','ACTIVE_THEME')->first();
        if(isset($current_theme)){
            if(!isset($current_theme['config_value'])){
                return view('welcome');
            }
        }else{
            return view('welcome');
        }
        $logo = Configuration::where('config_title', '=','SITE_LOGO')->first();
        $currency = Configuration::where('config_title', '=','DEFAULT_CURRENCY')->first();
        $currencyType = Configuration::where('config_title', '=','DECIMAL_POINT')->first();
        $currType ='';
        if($currencyType['config_value'] == 1){
            $currType ='.00';            
        } 
        
        Theme::set($current_theme['config_value']);        
        $categories = Category::join('media', 'category.media_id', '=', 'media.id')->select('category.*','media.media_url')->where('parent_id', '=', null)->get();
        $uuid = (string) Str::uuid();
        if($request->cookie('uuid') != null){
            $uuid = $request->cookie('uuid');
        }
        $cartcount = Cart::get_cart_count($uuid);
        $user = Auth::user();
        $wishlist = 0;
        $auth_status = false;
        if(isset($user)){
            $auth_status = true;
            $wishlist  = Wishlist::get_wishlist_count($user->id);
        }
        $minPrice = Product::orderByRaw(' CAST(total_cost as UNSIGNED) asc')->first();
        if(isset($minPrice)){
           $minPrice= $minPrice['total_cost'];
        }else{
            $minPrice= 0;
        }
        $maxPrice = Product::orderByRaw(' CAST(total_cost as UNSIGNED) desc')->first();
        if(isset($maxPrice)){
           $maxPrice= $maxPrice['total_cost'];
        }else{
            $maxPrice= 0;
        }
        $pages = Page::orderBy('page_title','asc')->get();
        $reviewPlugin = Addon::where('status',1)->where('add_on_constant', "REVIEW")->first();
        
        view()->share('auth_status',$auth_status);
        view()->share('review',$reviewPlugin);
        view()->share('categories',$categories);
        view()->share('minPrice',  $minPrice);
        view()->share('pages',  $pages);
        view()->share('maxPrice',  $maxPrice);
        view()->share('client_uuid',$uuid);
        view()->share('currency', $currency['config_value']);
        view()->share('currType', $currType);
        view()->share('js_files', $js_files);
        view()->share('cartcount', $cartcount);
        view()->share('wishlistcount', $wishlist);
        view()->share('logo', $logo['config_value']);
        return $uuid;
    }

    public static function adminSession(){
        $addons = Addon::where('status',1)->get();
        $user = Auth::user();
        view()->share('addonslist',$addons);
        view()->share('user',$user);
    }
}
