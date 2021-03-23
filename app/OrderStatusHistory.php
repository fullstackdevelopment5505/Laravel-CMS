<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    protected $table = 'order_status_history';
    
    protected $fillable = [
        'user_id',
        'order_id',
        'order_status', // 0 = Ordered, 1 = Packed, 2 = Shipped, 3 = Delivered
        'status_description'
    ];
    protected $hidden = [
        'updated_at', 'created_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }
}
