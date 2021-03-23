<?php

use Illuminate\Support\Facades\Route;
use App\GlobalConfig;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Product;
use App\ProductCategory;
use App\ProductImages;
use App\Cart;
use App\User;
use App\Page;
use App\Role;
use App\VerifyUser;
use App\UserAddress;
use App\Wishlist;
use App\Order;
use App\OrderProduct;
use App\OrderStatusHistory;
use App\Addon;
use App\Mail\VerifyMail;
use App\Mail\ForgotMail;
use App\Mail\OrderPlaced;
use App\Mail\UserAcknowledgement;
use App\Mail\AdminMessage;
use App\ReleatedProduct;
use App\ProductOptions;
use App\Configuration;
use App\ContactDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


Auth::routes();
Route::get('/page/{slug}', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    $slug = $request->route('slug');
    $page = Page::leftJoin('media', 'page.page_thumbnail', '=', 'media.id')->select('page.*','media.media_url')->where('page_slug', $slug)->first();
    return view('page', ['page'=>$page]);
});
Route::get('/', function (Request $request) {
    
    $uuid = GlobalConfig::currentThemeApply($request);
    $onhomes = Product::leftJoin('media', 'product.primary_image', '=', 'media.id')
    ->select('product.*','media.media_url')->where('product.on_home', 1)->get();
    $onsales = Product::leftJoin('media', 'product.primary_image', '=', 'media.id')
    ->select('product.*','media.media_url')->where('on_sale', 1)->get();
    // Deal Of The Week code
    $Deal_of_the_week = Product::leftJoin('media', 'product.primary_image', '=', 'media.id')
    ->select('product.*','media.media_url')->where('on_deal', 1)->get();
    $reviewPlugin = Addon::where('status',1)->where('add_on_constant', "REVIEW")->first();
    $userReviews = array();
    if(isset($reviewPlugin)){
        $userReviews = DB::table('product_review')->leftJoin('users', 
        'product_review.user_id', '=', 'users.id')
        ->leftJoin('product', 'product.id', '=', 'product_review.product_id')
        ->select('product_review.*','users.fullname','product.product_name', 'users.profile')
        ->where('show_home', '1')->where('product_review.status', '1')->get();
    }
    $response = new Response(view('welcome',
    ['onhomes'=>$onhomes, 
    'onsales'=>$onsales,
    'ondeal'=>$Deal_of_the_week, 
    'review'=>$userReviews]));
    $response->withCookie(cookie('uuid', $uuid, 45000000));
    return $response;
});
Route::get('/product-category', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    return view('category');
});
Route::get('/product', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    $sort_type = $request->get('sorttype');
    $query = $request->get('keyword');
    $title = "Product";
    if($request->has('title')){
        $title = $request->get('title');
    }
    $category = $request->get('category');
    $onsale = $request->get('onsale');
    $minamount = $request->get('minamount');
    $maxamount = $request->get('maxamount');
    $products = Product::leftJoin('media', 'product.primary_image', '=', 'media.id')
    ->select('product.*','media.media_url');
    if(isset($category)){
        $products = $products->leftJoin('product_category', 'product_category.product_id', '=', 'product.id')
            ->join('category',function ($join) {
                $join->on('category.id', '=', 'product_category.category_id');
            });;
        
        $category = explode("ˆ",$category);
        $count = 0;
        foreach ($category as $key) {
            if($count == 0){
                $products = $products->where('product_category.category_id', $key);
                $products = $products->orWhere('category.category_name', 'like', '%'.$key.'%');
            }else{
                $products = $products->orWhere('product_category.category_id', $key);
                 $products = $products->orWhere('category.category_name', 'like', '%'.$key.'%');
            }
            $count++;
        }        
    }
    if(isset($query)){
        $products = $products->where('product.product_name', 'like', '%'.$query.'%');
    }   
    if(isset($onsale)){
        $products = $products->where('product.on_sale', $onsale);
    }
    if(isset($minamount) && isset($maxamount)){
        $products = $products->whereRaw('CAST(total_cost as UNSIGNED) between '.$minamount.' and '.$maxamount);
    }
    if($request->ajax()){
        $products = $products->orderBy('total_cost', $sort_type)->paginate(9);
        return view('part.product',['products'=>$products]); 
    }else{
        $products = $products->orderBy('total_cost', 'asc')->paginate(9);        
        return view('product',['products'=>$products, 'title'=>$title]); 
    }
});
Route::get('/product-detail/{slug}', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    $slug = $request->route('slug');
    $product = Product::leftJoin('media', 'product.primary_image', '=', 'media.id')
    ->select('product.*','media.media_url')->where('product_slug', $slug)->first();
    $product_category = ProductCategory::
    join('category', 'product_category.category_id', 'category.id')
    ->select('category.category_name')
    ->where('product_category.product_id', $product['id'])->get();
    $data = array();
    foreach($product_category as $row){
        array_push($data,$row['category_name']);
    }
    $product_images = ProductImages::
    leftJoin('media', 'product_images.media_id', '=', 'media.id')
    ->select('product_images.*','media.media_url')->where('product_id', $product['id'])->get();
    $product_review = array();
    $reviewPlugin = Addon::where('status',1)->where('add_on_constant', "REVIEW")->first();
    if(isset($reviewPlugin)) {
        $product_review = DB::table('product_review')->leftJoin('users', 'product_review.user_id', '=', 'users.id')
        ->select('product_review.*','users.fullname')->where('product_id', $product['id'])->where('product_review.status', '1')->get();
    }   
    $related_product = ReleatedProduct::
    leftJoin('product', 'related_product.related_product_id', '=', 'product.id')->
    leftJoin('media', 'product.primary_image', '=', 'media.id')
    ->select('product.*','media.media_url')->where('product_id', $product['id'])->get();
    $total = 0;
    foreach ($product_review as $rating) {
        $total = $total + $rating->rating_star;
    }
    $avgrating = 0;
    if($total != 0){
        $avgrating = $total / sizeof($product_review);
    }
    $productsize = ProductOptions::where('product_id', $product['id'])->where('option_name', 'like', '%size%')->first();
    $productcolor = ProductOptions::where('product_id', $product['id'])->where('option_name', 'like', 'color%')->first();
    return view('productdetail', [
    'productcolor'=>$productcolor,
    'productsize'=>$productsize,
    'avgrating'=>$avgrating,
    'relatedproduct'=>$related_product,
    'productreview'=>$product_review,
    'product'=>$product, 
    'product_category'=>implode(',', $data), 
    'product_images'=>$product_images]);
});
Route::get('/order-detail/{orderId}', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    $orderId = $request->route('orderId');
    $user = Auth::user();
    if(!isset($user)){
        return Redirect::to('/login');
    }
    $reviewPlugin = Addon::where('status',1)->where('add_on_constant', "REVIEW")->first();
    if(isset($reviewPlugin)) {
        $order = Order::leftJoin('product_review', 'product_review.order_id', '=', 'order.id')
        ->select('order.*', 'product_review.rating_star', 'product_review.review_comment')->where('order_no', $orderId)->first();
    }else{
        $order = Order::where('order_no', $orderId)->first();
    }
    $carts = OrderProduct::join('product', 'order_product.product_id', 'product.id')
    ->leftJoin('media', 'product.primary_image', '=', 'media.id')->select('order_product.*', 'product.product_name', 'product.product_sku','product.product_slug', 'media.media_url')
    ->where('order_id', $order->id)->get();
    return view('orderdetail',['order'=>$order, 'carts'=>$carts]);
});
Route::get('/order/invoice/{orderId}', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    $orderId = $request->route('orderId');
    $user = Auth::user();
    if(!isset($user)){
        return Redirect::to('/login');
    }
    $order = Order::where('order_no', $orderId)->first();
    $carts = OrderProduct::join('product', 'order_product.product_id', 'product.id')
    ->leftJoin('media', 'product.primary_image', '=', 'media.id')
    ->select('order_product.*', 'product.product_name', 'product.product_sku','product.product_slug', 'media.media_url')
    ->where('order_id', $order->id)->get();
    $sitetitle = Configuration::where('config_title', 'SITE_TITLE')->first();
    $sitelogo = Configuration::where('config_title', 'SITE_LOGO')->first();
    $siteurl = Configuration::where('config_title', 'SITE_ADDRESS')->first();    
    $pdf = PDF::loadView('master.invoice', ['order'=>$order, 'carts'=>$carts,
    'sitetitle'=>$sitetitle['config_value'],
    'sitelogo'=>$sitelogo['config_value'],
    'siteurl'=>$siteurl['config_value']]);
    return $pdf->download('INVOICE_'.$orderId.'.pdf');
});

Route::get('/contact', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    return view('contact');
});
Route::post('/contactDetail', function (Request $request) {    
    $data =$request->all();   
    ContactDetail::create([
        'contact_name'=>$data['contact_name'],
        'contact_email'=>$data['contact_email'],
        'message'=>$data['message']        
    ]);
    $UserAcknowledgement = $data['contact_name'];
    $AdminMessage;
    $AdminMessage['contact_name']=$data['contact_name'];
    $AdminMessage['contact_email']=$data['contact_email'];
    $AdminMessage['message']=$data['message'];
    $AdminEmail = Configuration::where('config_title', 'ADMINISTRATOR_EMAIL')->first();    
       
    Mail::to($AdminEmail['config_value'])->send(new AdminMessage($AdminMessage));
    Mail::to($data['contact_email'])->send(new UserAcknowledgement($UserAcknowledgement));
    return Redirect::back()->with('status', 'sent Successfully.');
   
});
Route::get('/cart', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    $uuid = $request->cookie('uuid');
    $carts = Cart::join('product', 'cart.product_id', 'product.id')->select('cart.*', 'product.product_name', 'product.product_sku','product.product_slug')->where('ref_id', $uuid)->get();
    return view('cart', ['carts'=>$carts]);
});
Route::get('/checkout', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    $uuid = $request->cookie('uuid');
    $user = Auth::user();
    $addresses = UserAddress::where('user_id', $user->id)->get();
    $default_address = UserAddress::where('user_id', $user->id)->where('default', '1')->first();
    $carts = Cart::join('product', 'cart.product_id', 'product.id')->select('cart.*', 'product.product_name', 'product.product_sku','product.product_slug')->where('ref_id', $uuid)->get();
    return view('checkout', ['defaultaddress'=>$default_address, 'addresses'=>$addresses, 'carts'=>$carts, 'user'=>$user]);
});
Route::post('/checkout', function (Request $request) {
    $data = $request->all();
    $user = Auth::user();
    $orderid = Order::get_last_order_id();
    $order = Order::create([
        'user_id'=>$user->id,
        'order_no'=>$orderid,
        'fullname'=>$data['fullname'],
        'contact_no'=>$data['phone'],
        'email'=>$data['email'],
        'address'=>$data['address'],
        'city'=>$data['city'],
        'country'=>$data['country'],
        'zipcode'=>$data['zipcode'],
        'order_status'=>0,
        'totalprice'=>$data['totalprice'],
        'payment_type'=>$data['payment_type'],
        'payment_id'=>$data['payment_id']
    ]);
    OrderStatusHistory::create([
        'user_id'=>$user->id,
        'order_id'=>$order->id,
        'order_status'=>0,
        'status_description'=>'Order placed successfully'
    ]);
    $orderDetail = json_decode($data['carts']);
    foreach ($orderDetail as $productData) {
        OrderProduct::create([
            'user_id'=>$user->id,
            'order_id'=>$order->id,
            'product_id'=>$productData->product_id,
            'qty'=>$productData->qty,
            'price'=>$productData->price,
            'options'=>$productData->options
        ]);
    }
    $uuid = $request->cookie('uuid');
    Cart::where('ref_id', $uuid)->delete();
    Mail::to($data['email'])->send(new OrderPlaced($order));
    return Redirect::to('/myorder')->with('status','Order placed successfully');
});
Route::post('/validate-email', function (Request $request) {
    $data = $request->all();
    $user = User::where('email', $data['email'])->first();
    if(isset($user) ){
        echo json_encode(false);
    }else{
        echo json_encode(true);
    }
});
Route::get('/forgot', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    $user = Auth::user();
    if(isset($user)){
        return redirect()->intended('myaccount');
    }
    return view('forgot');
});
Route::post('/forgot', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    request()->validate([
        'email' => 'required|email'
    ]);
    $data = $request->all();
    $user = User::where('email', $data['email'])->first();
    if(isset($user) ){
        $password = time();
        $user->password = Hash::make($password);
        $user->save();
        $tmpUser = $user;
        $tmpUser->password =$password;
        Mail::to($user->email)->send(new ForgotMail($tmpUser));
        return redirect('/login')->with('status', "We sent you temporary password on your register email id. Check your email and login with new password.");
    }else{
        return redirect('/forgot')->with('warning', "Sorry your email cannot be identified.");
    }
});

Route::get('/wishlist', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    $user = Auth::user();
    if(!isset($user)){
        return Redirect::to('/login');
    }
    $wishlist = Wishlist::join('product', 'wishlist.product_id', 'product.id')
    ->leftJoin('media', 'product.primary_image', '=', 'media.id')
    ->select('product.*','media.media_url')
    ->where('wishlist.user_id', $user->id)->get();
    return view('wishlist', ['wishlists'=>$wishlist]);
});
Route::get('/myaccount', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    $user = Auth::user();
    if(!isset($user)){
        return Redirect::to('/login');
    }    
    $userid = Auth::user()->id; 
    $data = UserAddress::all()->where('user_id',$userid);    
    return view('myaccount',['data'=>$data]);
   
});

Route::post('/updatemyaccount', function (Request $request) {    
    $data =$request->all();
    $fullname = $data['fullname'];
    $mobile = $data['mobile'];   
    $user = User::where('email', Auth::user()->email)->first();
    $user->update([
        'fullname'=> $fullname,
        'mobile'=> $mobile
    ]);
    return Redirect::to('/myaccount')->with('status','Update Successfully');
});
Route::get('/deleteuserAddress', function (Request $request) {  
    $id = $request->query('id');
    $userAddres = UserAddress::where('id', $id)->first();
    $userAddres->delete();
    return Redirect::to('/myaccount')->with('status','Address deleted Successfully');
});
Route::get('/editeuserAddress', function (Request $request) {  
    $data = $request->all();
    $id = $data['id'];
    $userAddres = UserAddress::where('id', $id)->first();   
    //return json_encode(array($userAddres)); 
    return json_encode($userAddres); 
   
});
Route::get('/set_userAddress', function (Request $request) {  
    $id = $request->query('id');
    $allAddresss = UserAddress::where('user_id', '=', Auth::user()->id)->update([
        'default' => 0
    ]); 
    $userAddres = UserAddress::where('id', $id)->first(); 
    $userAddres->update([
        'default'=> 1
    ]);
    return Redirect::to('/myaccount')->with('status','Address set Successfully');
});

Route::post('/useraddress', function (Request $request) {    
    $data =$request->all();
    $userid = Auth::user()->id;   
    $user = UserAddress::create([
        'user_id'=>$userid,
        'address'=>$data['address'],
        'city'=>$data['city'],
        'state'=>$data['state'],
        'country'=>$data['country'],
        'contact_no'=>$data['contact_no'],
        'zipcode'=>$data['zipcode'],
        'address_type'=>$data['addType'],
        'default'=>0
    ]);     
     return Redirect::to('/myaccount')->with('status','Address Add Successfully');
});
Route::post('/updateuseraddress', function (Request $request) {    
    $data =$request->all();      
    $Add_id = $data['add_id'];
    $userAddress = UserAddress::where('id','=', $Add_id)->first();
    $userAddress->update([        
        'address'=>$data['addressUpdate'],
        'city'=>$data['cityUpdate'],
        'state'=>$data['stateUpdate'],
        'country'=>$data['countryUpdate'],
        'contact_no'=>$data['contact_noUpdate'],
        'zipcode'=>$data['zipcodeUpdate'],
        'address_type'=>$data['addTypeUpdate']        
    ]);     
     return Redirect::to('/myaccount')->with('status','Address Update Successfully');
});
Route::get('/register', function (Request $request) {
    GlobalConfig::currentThemeApply($request); 
    $user = Auth::user();
    if(isset($user)){
        return redirect()->intended('myaccount');
    }
    return view('register');
});
Route::get('/verify/{token}', function ($token) {
    $verifyUser = VerifyUser::where('token', $token)->first();
    if(isset($verifyUser) ){
        $user = $verifyUser->user;
        if(!$user->verified) {
            $verifyUser->user->verified = 1;
            $verifyUser->user->save();
            $status = "Your e-mail is verified. You can now login.";
        }else{
            $status = "Your e-mail is already verified. You can now login.";
        }
    }else{
        return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
    }
    return redirect('/login')->with('status', $status);
});
Route::post('/register', function (Request $request) {
    GlobalConfig::currentThemeApply($request); 
    $username= $request->get('username');
    $pass= $request->get('pass');   
    $Password = Hash::make($pass);
    $user = User::where('email','=', $username)->first();
    if ($user) {           
        return Redirect::to('/register')->with('error','You have allready created account Please login');
    }
    $user = User::create([
        'email'=>$username,
        'password'=>$Password,
        'fullname'=>$request->get('fullname'),
        'mobile'=>$request->get('mobile')
    ]);   
    $user->roles()->attach(Role::where('name', 'CUSTOMER')->first());
    $verifyUser = VerifyUser::create([
        'user_id' => $user->id,
        'token' => sha1(time())
    ]);
    Mail::to($user->email)->send(new VerifyMail($user));
    $user = User::where('email','=', $username)->first();
    if ($user) {           
        return Redirect::to('/register')->with('status','We sent you an activation link on email. Check your email and click on the link to verify.');
    }    
    return view('register');
});
Route::get('/changepass', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    $user = Auth::user();
    if(!isset($user)){
        return Redirect::to('/login');
    }
    return view('/changepass');
});

Route::post('/changepassword', function (Request $request) {
    GlobalConfig::currentThemeApply($request); 
    $oldpass= $request->get('oldpassword');
    $newpass= $request->get('newpassword');     
    $PasswordOld = Hash::make($oldpass);
    $PasswordNew = Hash::make($newpass);
    $userID = session('userID');  
    if($userID !=''){ 
        $user = User::where('id','=', $userID)->first();
        if ($user) {
            $user->update([
                'password'=> $PasswordNew
            ]);
            return Redirect::to('/changepass')->with('status','Your Password change Successfully');
        }     
    }else
    {
        return view('login');
    }   
});
Route::get('/login', function (Request $request) {
    GlobalConfig::currentThemeApply($request); 
    $user = Auth::user();
    if(isset($user)){
        return redirect()->intended('myaccount');
    }
    $query= $request->query('redirect');
    if(!isset($query)){
         $query = 'myaccount';
    }
    return view('login',['redirect'=>$query]);
});
Route::post('/login', function (Request $request) {
    $redirect = $request->get('redirect');
    $role = 'CUSTOMER';
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        if (!$user->verified) {
            auth()->logout();
            return Redirect::back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        if(!$user->hasRole($role)){
            auth()->logout();
            return Redirect::back()->with('warning', 'You are unauthorised to access this panel.');
        }
        GlobalConfig::currentThemeApply($request);
        return redirect()->intended($redirect);
    }else{
        dd("dasdasdas");
    }    
    return Redirect::back()->withErrors('Oppes! You have entered invalid credentials');
});
Route::get('/logout', function (Request $request) {
    Session::flush();
    Auth::logout();
    return Redirect::to('/login');
});
Route::get('/myorder', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    $user = Auth::user();
    if(!isset($user)){
        return Redirect::to('/login');
    }
    $orders = Order::where('user_id', $user->id)->get();
    return view('myorder',['orders'=>$orders]);
});
Route::get('/deletecartitem', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    $id = $request->query('id');
    $cartItem = Cart::where('id', $id)->first();
    $cartItem->delete();
    return Redirect::to('/cart')->with('status','Cart item deleted successfully');
});
Route::get('/updatecartqty', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    $id = $request->query('cartId');
    $qty = $request->query('qty');
    $cartItem = Cart::where('id', $id)->first();
    $cartItem->update([
        'qty'=> $qty
    ]);
    GlobalConfig::currentThemeApply($request);
    $uuid = $request->cookie('uuid');
    $carts = Cart::join('product', 'cart.product_id', 'product.id')->select('cart.*', 'product.product_name', 'product_sku')->where('ref_id', $uuid)->get();
    return view('part.cart', ['carts'=>$carts, 'status'=>'Cart item updated successfully']);
});
Route::post('/addtocart', function (Request $request) {
    $data = $request->all();
    $uuid = $request->cookie('uuid');
    $data['ref_id'] = $uuid;
    $cart = Cart::where('ref_id', $uuid)->where('product_id',$data['product_id'])->first();
    if(empty($cart)){
        Cart::create($data);
    }else{
        $qty = (int) $cart['qty'];
        $cart->update([
            'qty' => ($qty++),
            'price' => $cart['price'],
            'options' => $cart['options']
        ]);
    }
    $cartcount = Cart::get_cart_count($uuid);
    return response()
            ->json(['message' => 'Product added successfully', 'count'=>$cartcount]);
});

Route::post('/addtowishlist', function (Request $request) {
    $data = $request->all();
    $user = Auth::user();
    $data['user_id'] = $user->id;
    $wishlist = Wishlist::where('user_id', $user->id)->where('product_id',$data['product_id'])->first();
    $message = "";
    if(empty($wishlist)){
        Wishlist::create($data);
        $message = 'Wishlist product added successfully';
    }else{
        $message = 'You have already added product into wishlist';
    }
    $wishlist  = Wishlist::get_wishlist_count($user->id);
    return response()->json(['message' => $message, 'count'=>$wishlist]);
});

Route::post('/removewishlist', function (Request $request) {
    $data = $request->all();
    $user = Auth::user();
    $data['user_id'] = $user->id;
    $wishlist = Wishlist::where('user_id', $user->id)->where('product_id',$data['product_id'])->first();
    $message = "";
    if(!empty($wishlist)){
        $wishlist->delete();
        $message = 'Wishlist product removed successfully';
    }else{
        $message = 'You have already removed product into wishlist';
    }
    $wishlist  = Wishlist::get_wishlist_count($user->id);
    return response()->json(['message' => $message, 'count'=>$wishlist]);
});

Route::get('/demo', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    return view('demo');
});
Route::get('/demo/store-front', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    return view('storefront');
});
Route::get('/demo/admin-dashboard', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    return view('admindashboard');
});
Route::get('/download', function (Request $request) {
    GlobalConfig::currentThemeApply($request);
    return view('download');
});


// Admin panel
Route::group(['prefix' => 'textla'], function(){
    Route::get('/login', [ 'as' => 'login', 'uses' => 'SuperAdminController@index']);
    Route::post('/post-login', 'SuperAdminController@postLogin'); 
    Route::get('/logout', 'SuperAdminController@logout'); 
    Route::get('/dashboard',  'SuperAdminDashboardController@index');
    Route::get('/customer',  'SuperAdminUsersController@index');
    Route::get('/customer/profile',  'SuperAdminUsersController@viewProfile');
    Route::get('/category', 'SuperAdminCategoryController@index');
    Route::get('/category/create', 'SuperAdminCategoryController@create');
    Route::get('/category/update', 'SuperAdminCategoryController@update');
    Route::post('/category/post-create', 'SuperAdminCategoryController@createCategory');    
    Route::post('/category/post-update', 'SuperAdminCategoryController@updateCategory');  
    Route::post('/category/delete', 'SuperAdminCategoryController@delete');
    Route::get('/appearance',  'SuperAdminAppearanceController@index');
    Route::get('/appearance/apply', 'SuperAdminAppearanceController@themeApply');
    Route::get('/generalsetting',  'SuperAdminGeneralSettingController@index');
    Route::post('/generalsetting/update',  'SuperAdminGeneralSettingController@updateSetting');
    Route::get('/mailsetting',  'SuperAdminMailSettingController@index');
    Route::post('/mailsetting/update',  'SuperAdminMailSettingController@updateSetting');
    Route::get('/media',  'SuperAdminMediaController@index');
    Route::post('/media/upload',  'SuperAdminMediaController@uploadMedia');
    Route::post('/media/delete',  'SuperAdminMediaController@delete');
    Route::get('/product', 'SuperAdminProductController@index');
    Route::get('/product/create', 'SuperAdminProductController@create');
    Route::get('/product/update', 'SuperAdminProductController@update');
    Route::get('/product/detail', 'SuperAdminProductController@getProductDetail');
    Route::post('/product/post-create', 'SuperAdminProductController@createProduct');
    Route::post('/product/post-update', 'SuperAdminProductController@updateProduct');
    Route::get('/product/export', 'SuperAdminProductController@productDownload');
    Route::post('/product/delete', 'SuperAdminProductController@delete');
    Route::get('/page', 'SuperAdminPageController@index');
    Route::get('/page/create', 'SuperAdminPageController@create');
    Route::get('/page/update', 'SuperAdminPageController@update');
    Route::post('/page/delete', 'SuperAdminPageController@deletePage');
    Route::post('/page/post-create', 'SuperAdminPageController@postCreate');
    Route::post('/page/post-update', 'SuperAdminPageController@postUpdate');
    Route::get('/page/detail', 'SuperAdminPageController@getPageDetail');
    Route::get('/page/slug', 'SuperAdminPageController@getPageSlug');
    Route::get('/currency', 'SuperAdminCurrencyController@index');
    Route::get('/currency/setCurrency', 'SuperAdminCurrencyController@currencySet');
    Route::get('/product/sale', 'SuperAdminProductController@saleUpdate');
    Route::get('/orderlist', 'SuperAdminOrderController@index');
    Route::get('/orderview', 'SuperAdminOrderController@viewOrder');
    Route::get('/orderview/changeorderStatus', 'SuperAdminOrderController@changeorderStatus');
    Route::post('/orderlist/ordercancel', 'SuperAdminOrderController@cancelorder');
    Route::get('/add-ons', 'SuperAdminAddonsController@index');
    Route::get('/add-ons/activate', 'SuperAdminAddonsController@activate');
    Route::get('/paymentsetting', 'SuperAdminPaymentsettingController@index');
    Route::post('/product/on_dealproductAdd', 'SuperAdminProductController@on_dealproductAdd');
    Route::post('/product/on_dealproductRemove', 'SuperAdminProductController@on_dealproductRemove');
    Route::get('/usercreate', 'SuperAdminUsersController@user');
    Route::post('/user/create', 'SuperAdminUsersController@userAdd');
    Route::get('/role', 'SuperAdminUsersController@role');
    Route::get('/rolecreate', 'SuperAdminUsersController@rolecreate');
    Route::get('/role/edit', 'SuperAdminUsersController@roleEdit');
    Route::post('/role/create', 'SuperAdminUsersController@roleAdd');
    Route::post('/role/update', 'SuperAdminUsersController@roleUpdate');
    Route::post('/role/delete', 'SuperAdminUsersController@roleDelete');
    Route::get('/user', 'SuperAdminUsersController@user');
    Route::get('/usercreate', 'SuperAdminUsersController@usercreate');
    Route::get('/useredit', 'SuperAdminUsersController@userEdit');
    Route::post('/userupdate', 'SuperAdminUsersController@userUpdate');
    Route::post('/userdelete', 'SuperAdminUsersController@userDelete');
    Route::get('/adminprofile', 'SuperAdminUsersController@adminProfile');
    Route::post('/adminprofile/update', 'SuperAdminUsersController@adminProfileUpdate');
    Route::post('/adminprofile/changepassword', 'SuperAdminUsersController@adminChangePassword');
    Route::get('/contactMessage', 'SuperAdminContactMessageController@index');
});
