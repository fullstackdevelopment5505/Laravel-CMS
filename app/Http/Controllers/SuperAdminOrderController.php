<?php

namespace App\Http\Controllers;
use Validator,Redirect,Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;use App\GlobalConfig;
use Illuminate\Support\Collection;
use App\Order;
use App\OrderProduct;
use App\OrderStatusHistory;
use App\Product;
use App\Configuration;

class SuperAdminOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:SUPER_ADMIN');GlobalConfig::adminSession();
    }

    public function index(Request $request)
    {
        $currency = Configuration::where('config_title', '=','DEFAULT_CURRENCY')->first();
        $currencyType = Configuration::where('config_title', '=','DECIMAL_POINT')->first();
        $currType ='';
        if($currencyType['config_value'] == 1){
            $currType ='.00';            
        }  
        $sort_by = $request->get('sortby');
        $sort_type = $request->get('sorttype');
        $query = $request->get('query');        
        if($request->ajax()){           
            $orders = Order::select('order.*'); 
            if(isset($query)){
                $orders = $orders->where('order_no', 'like', '%'.$query.'%')
                ->orWhere('fullname', 'like', '%'.$query.'%');
            }  
            $orders = $orders->orderBy($sort_by, $sort_type)->paginate(10);
            return view('admin.part.order_pagination', ['orders'=>$orders,'currency'=>$currency,'currType'=>$currType]);
        }else
        {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10); 
        return view('admin/orderlist',['orders'=>$orders,'currency'=>$currency,'currType'=>$currType]);
        }
        

    }  
    public function viewOrder(Request $request)
    {
        $currency = Configuration::where('config_title', '=','DEFAULT_CURRENCY')->first();
        $currencyType = Configuration::where('config_title', '=','DECIMAL_POINT')->first();
        $currType ='';
        if($currencyType['config_value'] == 1){
            $currType ='.00';            
        } 
        $orderid= $request->query('id');
        $orders = Order::where('order_no',$orderid)->first(); 

        $newOrderid = $orders['id'];  
        $order_product = OrderProduct::leftJoin('product', 'order_product.product_id', '=', 'product.id')
        ->leftJoin('media', 'product.primary_image', '=', 'media.id')        
        ->select('order_product.*','product.product_name','product.primary_image','media.media_url')
        ->where('order_product.order_id', '=', $newOrderid)->get();     
        
        // $order_product=OrderProduct::leftJoin('product', 'order_product.product_id', '=', 'product.id')
        //     ->select('order_product.*','product.product_name')
        //     ->orderBy('created_at', 'desc');
            //print_r($order_product1);
            $order_productHitory=OrderStatusHistory::where('order_id',$newOrderid)->get();
        return view('admin/orderview',['orders'=>$orders,'order_products'=>$order_product,'OrderStatusHistory'=>$order_productHitory,'currency'=>$currency]);   

    }  
    public function changeorderStatus(Request $request)
    {
        $data = $request->all();
        $orderstatus = $data['value'];
        $orderstatus_t1 = $data['orderid_t1'];

        $orderstatus_t2 = $data['orderid_t2'];
        $order_table = Order::where('order_no', '=',$orderstatus_t1)->first();
        $order_table->update([
            'order_status' => $orderstatus
        ]);       

        $order_status_table = OrderStatusHistory::where('order_id','=',$orderstatus_t2)
        ->where('order_status','=',$orderstatus)
        ->first();
        if($order_status_table != '')
        {
        $order_status_table->update([
            'order_status' => $orderstatus
        ]);
        
        }else{
            $order_status_table=OrderStatusHistory::create([
                'user_id'=>$order_status_table['user_id'],
                'order_id'=>$orderstatus_t2,
                'order_status' => $orderstatus
            ]);
            return ;  
        }
        return ;       
       return view('/textla/orderlist');
    }  
    public function cancelorder(Request $request)
    {
        $id = $request->query('id');
        
        $order = Order::where('id','=',$id)        
        ->first();        
        $order->update([
            'order_status' => 4
        ]);

        $order_status_table = OrderStatusHistory::where('order_id','=',$id)
        ->first();
        $order_status_table->update([
            'order_status' => 4
        ]);
             
        return Redirect::to('/textla/orderlist')->with('status','Order Cancelled successfully');
    }  
    
}
    
  