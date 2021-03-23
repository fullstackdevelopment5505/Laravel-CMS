<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_category';
    
    protected $fillable = [
        'category_id',
        'product_id'
    ];
    protected $hidden = [
        'updated_at', 'created_at'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function products()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
