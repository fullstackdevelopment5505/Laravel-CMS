<?php

namespace Textla\Review;

use App\Http\Controllers\Controller;
use Validator,Redirect,Response;
use Illuminate\Http\Request;
use Shipu\Themevel\Facades\Theme;
use Illuminate\Support\Facades\Storage;
use App\GlobalConfig;
use App\Order;
use App\OrderProduct;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');        
    }

    public function add(Request $request){
        $this->middleware('role:SUPER_ADMIN');
        GlobalConfig::adminSession();
        $sort_by = $request->get('sortby');
        $sort_type = $request->get('sorttype');
        $query = $request->get('query');
        $pages = ProductReview::select('product_review.*', 'product.product_name', 'users.fullname')
        ->leftJoin('product', 'product.id', '=', 'product_review.product_id')
        ->leftJoin('users', 'users.id', '=', 'product_review.user_id');
        if($request->ajax()){
            if(isset($query)){
                $pages = $pages->where('page_title', 'like', '%'.$query.'%')
                ->orWhere('page_description', 'like', '%'.$query.'%');
            }            
            $pages = $pages->orderBy($sort_by, $sort_type)->paginate(10);
            return view('review::part.pagination', compact('pages'));
        }else{
            $pages = $pages->orderBy('created_at', 'desc')->paginate(10);
            return view('review::add', compact('pages')); 
        }
    }

    public function onHome(Request $request){
        GlobalConfig::adminSession();
        $id = $request->get('id');
        $value = $request->get('value');
        $review = ProductReview::where('id', $id)->first();
        $review->update([
            'show_home'=>$value
        ]);
        echo("Change Successfully");
    }
    public function postReview(Request $request){
        $carts = OrderProduct::where('order_id', $request->get('orderid'))->get();
        $order = Order::where('id', $request->get('orderid'))->first();
        $order->update([
            'review_apply'=>'1'
        ]);
        foreach ($carts as $order) {
            ProductReview::create([
                'rating_star'=>$request->get('rating'),
                'product_id'=>$order->product_id,
                'order_id'=>$request->get('orderid'),
                'user_id'=>$request->get('userid'),
                'review_comment'=>$request->get('review')
            ]);    
        }
        
        return Redirect::back()->withSuccess('Product review apply successfully');
    }

    

    public function onStatus(Request $request){
        GlobalConfig::adminSession();
        $id = $request->get('id');
        $value = $request->get('value');
        $review = ProductReview::where('id', $id)->first();
        $review->update([
            'status'=>$value
        ]);
        echo("Status change Successfully");
    }
    
}
