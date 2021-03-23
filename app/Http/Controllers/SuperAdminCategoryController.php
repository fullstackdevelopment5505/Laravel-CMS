<?php

namespace App\Http\Controllers;
use Validator,Redirect,Response;
use Illuminate\Http\Request;
use App\Category;
use App\ProductCategory;
use App\Media;
use Illuminate\Support\Facades\Storage;
use App\GlobalConfig;



class SuperAdminCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:SUPER_ADMIN');
        GlobalConfig::adminSession();
    }

    public function index(Request $request)
    {
        $categories = Category::join('media', 'category.media_id', '=', 'media.id')->select('category.*','media.media_url')->where('parent_id', '=', null)->get();
        $allCategories = Category::join('media', 'category.media_id', '=', 'media.id')->select('category.*','media.media_url')->pluck('category_name','id', 'category_url', 'parent_id','media_url')->all();
        return view('admin/category',compact('categories','allCategories')); 
    }  
    
    public function create(Request $request)
    {
        $allCategories = Category::where('status', '=', 1)->get();
        $allMedia = Media::get();
        return view('admin/category/create',['categories'=> $allCategories,'medias'=>$allMedia]); 
    }   
    public function update(Request $request)
    {
        $id = $request->query('id');
        $categories = Category::where('status', '=', 1)->get();
        $category = Category::leftJoin('media', 'category.media_id', '=', 'media.id')->select('category.*','media.media_url')->where('category.id', '=', $id)->first();
        $medias = Media::get();
        return view('admin/category/edit',compact('category','categories','medias')); 
    } 
    public function delete(Request $request)
    {
        $id = $request->query('id');
        $category = Category::where('id', '=', $id)->first();
        if($category->children()->count() == 0) {
            $products = ProductCategory::where('category_id', '=', $id)->get();
            if(sizeof($products) == 0){
            Category::where('id', '=', $id)->delete();
            return Redirect::to('/textla/category')->with('status','Category deleted successfully');
            }else{
                return back()->with('error','You can not delete this category. This category have some products first remove that. ');
            }
        }else{
            return back()->with('error','You can not delete this category. This category have some children category first remove that. ');
        }
    } 
    
    public function createCategory(Request $request){
        request()->validate([
           'category_name' => 'required|unique:category',
           'media_id'=>'required'
        ]);
        // $fileName = time().'.'.$request->file('category_url')->extension();  
        // $request->file('category_url')->move(public_path('media'), $fileName);
        $data = $request->all();
        $category = Category::create([
            'category_name' => $data['category_name'],
            'media_id' => $data['media_id'],
            'parent_id' => (isset($data['parent_id']) ? $data['parent_id'] : null),
            'status'=>1
        ]);
        return Redirect::to('/textla/category')->with('status','Category created successfully');
    }
    public function updateCategory(Request $request){
        request()->validate([
           'category_name' => 'required',
           'media_id'=>'required'
        ]);
        $data = $request->all();
        $check = Category::where('id', '!=', $data['category_id'])->where('category_name', '=', $data['category_name'])->get();
        if($check->count() == 0) {
            $category = Category::where('id', '=', $data['category_id'])->update([
                'category_name' => $data['category_name'],
                'media_id' => $data['media_id'],
                'parent_id' => (isset($data['parent_id']) ? $data['parent_id'] : null)
            ]);            
            return Redirect::to('/textla/category')->with('status','Category updated successfully');
        }else{
            
        }
    }
    
}
