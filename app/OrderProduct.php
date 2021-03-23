<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';
    
    protected $fillable = [
        'user_id',
        'order_id',
        'product_id',
        'qty', 
        'price',      
        'options'
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

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
