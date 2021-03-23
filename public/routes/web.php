<?php

use Illuminate\Support\Facades\Route;
use Shipu\Themevel\Facades\Theme;
use App\Configuration;
Auth::routes();
Route::get('/', function () {
    $current_theme = Configuration::where('config_title', '=','ACTIVE_THEME')->first();
    Theme::set($current_theme['config_value']);
    return view('welcome');
});

// Admin panel
Route::group(['prefix' => 'cms_admin'], function(){
    Route::get('/login', [ 'as' => 'login', 'uses' => 'SuperAdminController@index']);
    Route::post('/post-login', 'SuperAdminController@postLogin'); 
    Route::get('/logout', 'SuperAdminController@logout'); 
    Route::get('/dashboard',  'SuperAdminDashboardController@index');
    Route::get('/users',  'SuperAdminUserController@index');
    Route::get('/category', 'SuperAdminCategoryController@index');
    Route::get('/category/create', 'SuperAdminCategoryController@create');
    Route::get('/category/update', 'SuperAdminCategoryController@update');
    Route::post('/category/post-create', 'SuperAdminCategoryController@createCategory');    
    Route::post('/category/post-update', 'SuperAdminCategoryController@updateCategory');  
    Route::post('/category/delete', 'SuperAdminCategoryController@delete');
    Route::get('/user/profile',  'SuperAdminUserController@viewProfile');
    Route::get('/appearance',  'SuperAdminAppearanceController@index');
    Route::get('/appearance/apply', 'SuperAdminAppearanceController@themeApply');
    Route::get('/generalsetting',  'SuperAdminGeneralSettingController@index');
    Route::post('/generalsetting/update',  'SuperAdminGeneralSettingController@updateSetting');
    Route::get('/mailsetting',  'SuperAdminMailSettingController@index');
    Route::post('/mailsetting/update',  'SuperAdminMailSettingController@updateSetting');
    Route::get('/media',  'SuperAdminMediaController@index');
    Route::post('/media/upload',  'SuperAdminMediaController@uploadMedia');
});
