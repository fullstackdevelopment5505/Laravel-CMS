<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Product;
use App\Order;
use App\Configuration;
use App\GlobalConfig;
use DB;
class SuperAdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:SUPER_ADMIN');GlobalConfig::adminSession();
    }

    public function index()
    {
        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $category = Category::get();
        $users = User::select('users.*')->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles',function ($join) {
                $join->on('roles.id', '=', 'role_user.role_id')->where('roles.name', 'USER');
            })->get();
        
        $product = Product::get();
        $order = Order::get();
        $instockproduct = Product::where('product_out_of_stock_status','INSTOCK')->get();
        $outstockproduct = Product::where('product_out_of_stock_status','OUTOFSTOCK')->get();
        $payment = Order::where('order_status', '3')->sum('totalprice');
        $orderedstatus = Order::where('order_status', '0')->get();
        $packedstatus = Order::where('order_status', '1')->get();
        $shippedstatus = Order::where('order_status', '2')->get();
        $deliveredstatus = Order::where('order_status', '3')->get();
        $cancelledstatus = Order::where('order_status', '4')->get();
        $currency = Configuration::where('config_title', '=','DEFAULT_CURRENCY')->first();
        $currencyType = Configuration::where('config_title', '=','DECIMAL_POINT')->first();
        $currType ='';
        if($currencyType['config_value'] == 1){
            $currType ='.00';            
        } 
        $monthlySalesOrder = array();
        $monthlySalesData = array();
        $monthlySalesPaymentMonth = array();
        $monthlySalesPaymentData = array();
        $totalMonthWiseOrder = DB::select("SELECT MONTH(created_at) as month, COUNT(created_at) as totalOrder FROM cms.order WHERE created_at >= NOW() - INTERVAL 1 YEAR GROUP BY MONTH(created_at)");
        foreach ($totalMonthWiseOrder  as $data) {
            $index = (int) $data->month;
            array_push($monthlySalesOrder, $month[$index - 1]);
            array_push($monthlySalesData, $data->totalOrder);
        }
        $totalMonthWiseOrderPayment = DB::select("SELECT MONTH(created_at) as month, sum(totalprice) as totalOrder FROM cms.order WHERE created_at >= NOW() - INTERVAL 1 YEAR GROUP BY MONTH(created_at)");
        foreach ($totalMonthWiseOrderPayment  as $data) {
            $index = (int) $data->month;
            array_push($monthlySalesPaymentMonth, $month[$index - 1]);
            array_push($monthlySalesPaymentData, $data->totalOrder);
        }
        $latestorder = Order::where('order_status', '0')->orderBy('created_at', 'desc')->paginate(5);
        $latestuser = User::select('users.*')->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles',function ($join) {
                $join->on('roles.id', '=', 'role_user.role_id')->where('roles.name', 'USER');
            })->orderBy('created_at', 'desc')->paginate(5);
       
        $recentsalesproduct = DB::select("SELECT product.*, media.media_url FROM (SELECT  product_id FROM cms.order_product  order by created_at desc) t1 JOIN product on product.id = product_id JOIN media ON media.id = product.primary_image  group by product_id LIMIT 5");
        $topsellingproduct = DB::select("SELECT totalSell, product.*, media.media_url FROM (SELECT  product_id, count(product_id) as totalSell FROM cms.order_product group by product_id) t1 JOIN product on product.id = product_id  JOIN media ON media.id = product.primary_image  group by product_id  order by totalSell desc");
        return view('admin/dashboard',[
        'totalUsers'=> sizeof($users), 
        'monthlySalesOrder'=>$monthlySalesOrder,
        'monthlySalesData'=>$monthlySalesData,
        'monthlySalesPaymentMonth'=>$monthlySalesPaymentMonth,
        'monthlySalesPaymentData'=>$monthlySalesPaymentData,
        'totalPayment'=> $payment, 
        'totalCategory'=>sizeof($category),
        'totalProduct'=>sizeof($product),
        'currency'=> $currency['config_value'],
        'currType'=> $currType,
        'totalOrderedstatus'=>sizeof($orderedstatus),
        'totalPackedstatus'=>sizeof($packedstatus),
        'totalShippedstatus'=>sizeof($shippedstatus),
        'totalDeliveredstatus'=>sizeof($deliveredstatus),
        'totalCancelledstatus'=>sizeof($cancelledstatus),
        'totalInstockproduct'=>sizeof($instockproduct),
        'totalOutstockproduct'=>sizeof($outstockproduct),
        'latestorder'=>$latestorder,
        'latestuser'=>$latestuser,
        'recentsalesproduct'=>$recentsalesproduct,
        'topsellingproduct'=>$topsellingproduct,
        'totalOrder'=>sizeof($order)
        ]);
    }
    
}
