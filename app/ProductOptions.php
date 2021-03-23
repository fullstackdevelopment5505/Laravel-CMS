<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOptions extends Model
{
    protected $table = 'product_options';
    
    protected $fillable = [
        'option_name',
        'options_values',
        'product_id'
    ];
    protected $hidden = [
        'updated_at', 'created_at'
    ];


    public function products()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
}
