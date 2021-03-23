<?php

namespace App\Http\Controllers;
use Validator,Redirect,Response;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Media;
use App\Page;
use App\ProductImages;
use App\Configuration;
use Illuminate\Support\Facades\Storage;use App\GlobalConfig;

class SuperAdminPageController extends Controller
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
            $pages = Page::select('page.*', 'media.media_url', 'media.file_type')->leftJoin('media', 'page.page_thumbnail', '=', 'media.id');
            if(isset($query)){
                $pages = $pages->where('page_title', 'like', '%'.$query.'%')
                ->orWhere('page_description', 'like', '%'.$query.'%');
            }            
            $pages = $pages->orderBy($sort_by, $sort_type)->paginate(10);
            return view('admin.part.page_pagination', compact('pages'));
        }else{
            $pages = Page::select('page.*', 'media.media_url', 'media.file_type')->leftJoin('media', 'page.page_thumbnail', '=', 'media.id');
            $pages = $pages->orderBy('created_at', 'desc')->paginate(10);
            return view('admin/page', compact('pages')); 
        }
    }  
    public function create(Request $request)
    {
        $allCategories = Category::where('status', '=', 1)->get();
        $allProduct = Product::get();
        $allMedia = Media::get();
        return view('admin/page/create',['categories'=> $allCategories, 'products'=>$allProduct, 'medias'=>$allMedia]); 
    }
    public function getPageDetail(Request $request){
        $id = $request->query('id');
        $page = Page::where('id', $id)->first();
        $siteconfig = Configuration::where("config_title", "SITE_ADDRESS")->first();
        $url = $siteconfig['config_value'].'/'.$page['page_slug'];
        return response()->json(['page'=>$page, 'url'=>$url]);
    }
    public function getPageSlug(Request $request){
        $name = $request->query('name');
        $slug = Page::slugify($name);
        $siteconfig = Configuration::where("config_title", "SITE_ADDRESS")->first();
        $url = $siteconfig['config_value'].'/'.$slug;
        return response()->json(['slug'=>$slug, 'url'=>$url]);
    }
    public function update(Request $request)
    {
        $id = $request->query('id');
        $page = Page::where('id', $id)->first();
        $allCategories = Category::where('status', '=', 1)->get();
        $allProduct = Product::get();
        $allMedia = Media::get();
        return view('admin/page/edit',['categories'=> $allCategories, 'products'=>$allProduct, 'medias'=>$allMedia]); 
    }
    public function postCreate(Request $request){
        $data = $request->all();      
        $slug = Page::slugify($data['page_title']);
        $product = Page::create([
            'page_title'=>$data['page_title'],
            'page_slug'=>$slug,
            'page_description'=>$data['page_description'],
            'page_thumbnail'=>$data['page_thumbnail'],
            'meta_tag_title'=>$data['meta_tag_title'],
            'meta_tag_keyword'=>$data['meta_tag_keyword'],
            'meta_tag_description'=>$data['meta_tag_description']
        ]);
        return Redirect::to('/textla/page')->with('status','Page created successfully');
    }

    public function postUpdate(Request $request){
        $data = $request->all();    
        $page = Page::where('id', $data['id'])->first();  
        $page->update([
            'page_title'=>$data['page_title'],
            'page_slug'=>$data['page_slug'],
            'page_description'=>$data['page_description'],
            'page_thumbnail'=>$data['page_thumbnail'],
            'meta_tag_title'=>$data['meta_tag_title'],
            'meta_tag_keyword'=>$data['meta_tag_keyword'],
            'meta_tag_description'=>$data['meta_tag_description']
        ]);
        return Redirect::to('/textla/page')->with('status','Page updated successfully');
    }
    public function deletePage(Request $request)
    {
        $id = $request->query('id');
        Page::where('id', '=', $id)->delete();
        return Redirect::to('/textla/page')->with('status','Page deleted successfully');
    }
    
}
    
  