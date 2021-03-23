<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{  
    protected $table = 'wishlist';
    
    protected $fillable = [
        'product_id',
        'user_id'
    ];
    protected $hidden = [
        'updated_at', 'created_at'
    ];

    public static function get_wishlist_count($userId)
    {
        $wishlist = Wishlist::where('user_id', $userId)->get();
        return sizeof($wishlist);        
    }
}
