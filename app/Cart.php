<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{  
    protected $table = 'cart';
    
    protected $fillable = [
        'ref_id',
        'product_id',
        'qty', 
        'price',      
        'options'
    ];
    protected $hidden = [
        'updated_at', 'created_at'
    ];

    public static function get_cart_count($ref)
    {
        $cart = Cart::where('ref_id', $ref)->get();
        return sizeof($cart);        
    }
}
