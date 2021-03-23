<?php

namespace App\Http\Controllers;
use Validator,Redirect,Response;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Media;
use App\ProductCategory;
use App\ProductImages;
use App\ReleatedProduct;
use App\Page;
use App\ProductOptions;
use App\Configuration;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;use App\GlobalConfig;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
class SuperAdminProductController extends Controller
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
        $currency = Configuration::where('config_title', '=','DEFAULT_CURRENCY')->first();
        $currencyType = Configuration::where('config_title', '=','DECIMAL_POINT')->first();
        $currType ='';
        if($currencyType['config_value'] == 1){
            $currType ='.00';            
        } 
        if($request->ajax()){
            $products = Product::leftJoin('media', 'product.primary_image', '=', 'media.id')->select('product.*','media.media_url');
            if(isset($query)){
                $products = $products->where('product.product_name', 'like', '%'.$query.'%');
            }            
            $products = $products->orderBy($sort_by, $sort_type)->paginate(10);
            return view('admin.part.product_pagination', compact('products'));
        }else
        {
            $products = Product::leftJoin('media', 'product.primary_image', '=', 'media.id')
            ->select('product.*','media.media_url')
            ->orderBy('created_at', 'desc')
            ->paginate(10);        
            return view('admin/product',['products'=>$products,'currType'=>$currType,'currency'=>$currency['config_value']]); 
        }
    }  
    
    public function create(Request $request)
    {
        $allCategories = Category::where('status', '=', 1)->get();
        $allProduct = Product::get();
        $allMedia = Media::get();
        return view('admin/product/create',['categories'=> $allCategories, 'products'=>$allProduct, 'medias'=>$allMedia]); 
    }

    public function postCreate(Request $request){
        
    }
    public function createProduct(Request $request){
        $data = $request->all();   
        $slug = Page::slugify($data['product_slug']);   
        $product = Product::create([
            'date_of_available' => $data['date_of_available'],
            'discount_date_end' => $data['discount_date_end'],
            'discount_date_start' => $data['discount_date_start'],
            'discount_price' => $data['discount_price'],
            'gross_total' => $data['gross_total'],
            'meta_tag_description' => $data['meta_tag_description'],
            'meta_tag_keyword' => $data['meta_tag_keyword'],
            'meta_tag_title' => $data['meta_tag_title'],
            'other_cost' => $data['other_cost'],
            'product_cost' => $data['product_cost'],
            'primary_image' => $data['primary_image'],
            'packing_cost' => $data['packing_cost'],
            'product_description' => $data['product_description'],
            'product_name' => $data['product_name'],
            'product_out_of_stock_status' => $data['product_out_of_stock_status'],
            'product_quantity' => $data['product_quantity'],
            'product_sku' => $data['product_sku'],
            'product_slug' => $slug,
            'product_status' => $data['product_status'],
            'product_upc' => $data['product_upc'],
            'require_shipping' => $data['require_shipping'],
            'shipping_cost' => $data['shipping_cost'],
            'shipping_height' => $data['shipping_height'],
            'shipping_length' => $data['shipping_length'],
            'shipping_weight' => $data['shipping_weight'],
            'shipping_width' => $data['shipping_width'],
            'tax_percent' => $data['tax_percent'],
            'total_cost' => $data['total_cost']           
        ]);
        foreach ($data['product_categories'] as $cat) {
            ProductCategory::create([
                'category_id'=>$cat,
                'product_id'=>$product['id']
            ]);
        }
        foreach ($data['product_images'] as $img) {
            ProductImages::create([
                'media_id'=>$img['id'],
                'product_id'=>$product['id']
            ]);
        }
        foreach ($data['related_products'] as $related) {
            ReleatedProduct::create([
                'related_product_id'=>$related,
                'product_id'=>$product['id']
            ]);
        }
        foreach ($data['product_options'] as $related) {
            ProductOptions::create([
                'option_name'=>$related['option_name'],
                'options_values'=>json_encode($related['options_values']),
                'product_id'=>$product['id']
            ]);
        }
        
        return Redirect::to('/textla/product')->with('status','Product created successfully');
    }

    public function update(Request $request)
    {
        $id = $request->query('id');
        $Product = Product::where('id', '=', $id)->first();
        $allCategories = Category::where('status', '=', 1)->get();
        $allProduct = Product::get();
        $allMedia = Media::get();
        return view('admin/product/edit',['categories'=> $allCategories, 'products'=>$allProduct, 'medias'=>$allMedia]); 
    
    }

    public function updateProduct(Request $request)
    {
        $data = $request->all();      
        $id = $data['id'];
        $product = Product::where('id', '=', $id)->first();
        $product->update($data);
        ProductCategory::where('product_id', '=', $product['id'])->delete();
        ProductImages::where('product_id', '=', $product['id'])->delete();
        ReleatedProduct::where('product_id', '=', $product['id'])->delete();
        ProductOptions::where('product_id', '=', $product['id'])->delete();
        foreach ($data['product_categories'] as $cat) {
            ProductCategory::create([
                'category_id'=>$cat['id'],
                'product_id'=>$product['id']
            ]);
        }
        foreach ($data['product_images'] as $img) {
            ProductImages::create([
                'media_id'=>$img['id'],
                'product_id'=>$product['id']
            ]);
        }
        foreach ($data['related_products'] as $related) {
            ReleatedProduct::create([
                'related_product_id'=>$related['id'],
                'product_id'=>$product['id']
            ]);
        }
        foreach ($data['product_options'] as $related) {
            ProductOptions::create([
                'option_name'=>$related['option_name'],
                'options_values'=>json_encode($related['options_values']),
                'product_id'=>$product['id']
            ]);
        }
        return Redirect::to('/textla/product')->with('status','Product created successfully');
    }
    public function on_dealproductAdd(Request $request)
    {
        $data = $request->all();      
        $id = $data['add_id'];        
        $product = Product::where('id', '=', $id)->first(); 
        //$created_at = "2014-06-26 04:07:31";
        $deal_end_date = $data['deal_end_date'].' '.$data['deal_hour'].':'.$data['deal_minute'].':'.$data['deal_second'];
        //print_r($product);
        $product->update([
            'on_deal' => 1,
            'deal_price' => $data['deal_price'],
            'deal_end_date' => $deal_end_date,
            'deal_description' => $data['deal_description']
        ]); 
        return Redirect::to('/textla/product')->with('status','Add Product Deal Of The Week successfully');
    }
    public function on_dealproductRemove(Request $request)
    {
        $id = $request->query('id');     
        $product = Product::where('id', '=', $id)->first();       
        $product->update([
            'on_deal' => 0,
            'deal_price' => null,
            'deal_end_date' => null,
            'deal_description' => null
        ]); 
        return Redirect::to('/textla/product')->with('status','Remove Product Deal Of The Week successfully');
    }
    
    public function delete(Request $request)
    {
        $id = $request->query('id');
       
        Product::where('id', '=', $id)->delete();
        ProductImages::where('product_id', '=', $id)->delete();
        ReleatedProduct::where('product_id', '=', $id)->delete();
        ProductOptions::where('product_id', '=', $id)->delete();
        return Redirect::to('/textla/product')->with('status','Product deleted successfully');
           
    } 
    
    public function getProductDetail(Request $request){
        $id = $request->query('id');
        $product = Product::where('id', '=', $id)->first();
        $prodctImages = ProductImages::join('media', 'product_images.media_id', '=', 'media.id')->where('product_images.product_id', '=', $id)->get();
        $prodctCategory = ProductCategory::join('category', 'product_category.category_id', '=', 'category.id')->select("category.*")->where('product_id', '=', $id)->get();
        $prodctRelated = ReleatedProduct::join('product', 'related_product.related_product_id', '=', 'product.id')->select("product.*")->where('product_id', '=', $id)->get();
        $prodctOptions = ProductOptions::where('product_id', '=', $id)->get();
        $product['product_images'] = $prodctImages;
        $product['product_categories'] = $prodctCategory;
        $product['product_options'] = $prodctOptions;
        $product['related_products'] = $prodctRelated;
        $allCategories = Category::where('status', '=', 1)->get();
        $allProduct = Product::get();
        return response()->json(['product'=>$product, 'productImages'=>$prodctImages, 'productCategory'=>$prodctCategory, 'relatedProduct'=>$prodctRelated, 'productOptions'=>$prodctOptions, 'allCategories'=>$allCategories, 'allProduct'=>$allProduct]);
    }

    public function productDownload()
    {
        return Excel::download(new ProductExport, 'ProductExport.xlsx');
    }   

    public function productUpload(Request $request)
    {
        if ($request->hasFile('file')) {
        $path = $request->file('file');
        $originalFileName = $path->getClientOriginalName();       
        Excel::import(new ProductImport, $path);
        return Redirect::to('/textla/product')->with('status','Product Import successfully');
  
        }
    }  

    public function saleUpdate(Request $request)
    {
        
        $id = $request->get('product_id');
        $col_name = $request->get('col_name');
        $col_value = $request->get('col_value');       
        if($col_value=='YES'){
            $col_value = 0;
        }else
        {
            $col_value = 1;
        }
        $ProValue = Product::where('id', '=',$id)->first();
        $ProValue->update([
            $col_name => $col_value
        ]);

      
        
    }
    
}


class ProductExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        return Product::all();

    }  
    public function headings(): array
    {
        return [
            'ProductID',
            'product_name',
            'product_sku',
            'product_slug',
            'product_description',
            'product_upc',
            'product_quantity',
            'product_out_of_stock_status',
            'date_of_available',
            'product_status',
            'primary_image',
            'gross_total',
            'packing_cost',
            'product_cost',
            'shipping_cost',
            'other_cost',
            'tax_percent',
            'total_cost',
            'discount_price',
            'discount_date_start',
            'discount_date_end',
            'meta_tag_title',
            'meta_tag_keyword',
            'meta_tag_description',
            'require_shipping',
            'shipping_width',
            'shipping_height',
            'shipping_length',
            'shipping_weight'
        ];
    }
}

class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Product([                  
            'product_name'=> $row['product_name'],
            'product_sku'=> $row['product_sku'],
            'product_slug'=> $row['product_slug'],
            'product_description '=> $row['product_description'],
            'product_upc'=> $row['product_upc'],
            'product_quantity'=> $row['product_quantity'],
            'product_out_of_stock_status'=> $row['product_out_of_stock_status'],
            'date_of_available'=> $row['date_of_available'],
            'product_status'=> $row['product_status'],
            'primary_image'=> $row['primary_image'],
            'gross_total'=> $row['gross_total'],
            'packing_cost'=> $row['packing_cost'],
            'product_cost'=> $row['product_cost'],
            'shipping_cost'=> $row['shipping_cost'],
            'other_cost'=> $row['other_cost'],
            'tax_percent'=> $row['tax_percent'],
            'total_cost'=> $row['total_cost'],
            'discount_price'=> $row['discount_price'],
            'discount_date_start'=> $row['discount_date_start'],
            'discount_date_end'=> $row['discount_date_end'],
            'meta_tag_title'=> $row['meta_tag_title'],
            'meta_tag_keyword'=> $row['meta_tag_keyword'],
            'meta_tag_description'=> $row['meta_tag_description'],
            'require_shipping'=> $row['require_shipping'],
            'shipping_width'=> $row['shipping_width'],
            'shipping_height'=> $row['shipping_height'],
            'shipping_length'=> $row['shipping_length'],
            'shipping_weight'=> $row['shipping_weight']
        ]);
    }
}


