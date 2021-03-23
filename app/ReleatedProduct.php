<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReleatedProduct extends Model
{
    protected $table = 'related_product';
    
    protected $fillable = [
        'related_product_id',
        'product_id'
    ];
    protected $hidden = [
        'updated_at', 'created_at'
    ];

    public function relatedProducts()
    {
        return $this->belongsTo('App\Product', 'related_product_id');
    }

    public function products()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
