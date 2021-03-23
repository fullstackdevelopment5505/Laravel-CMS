<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $table = 'product_images';
    
    protected $fillable = [
        'media_id',
        'product_id'
    ];
    protected $hidden = [
        'updated_at', 'created_at'
    ];

    public function media()
    {
        return $this->belongsTo('App\Media', 'media_id');
    }

    public function products()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
