<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    
    protected $fillable = [
        'user_id',
        'order_no',
        'fullname',
        'contact_no',
        'email',
        'address',
        'city',
        'state',
        'country',
        'zipcode',
        'order_status', // 0 = Ordered, 1 = Packed, 2 = Shipped, 3 = Delivered
        'totalprice',
        'payment_type',
        'payment_id',
        'review_apply'
    ];
    protected $hidden = [
        'updated_at', 'created_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

     public static function get_last_order_id()
    {
        $order = Order::latest()->first();
        if(empty($order)){
            return 'ORDER001';
        }  else {
            $orderid = $order->order_no;
            return ++$orderid;
        }
        
    }
}
