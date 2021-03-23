<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    
    protected $fillable = [
        'product_name',
        'product_sku',
        'product_slug',
        'product_description',
        'product_upc',
        'product_quantity',
        'product_out_of_stock_status',
        'date_of_available',
        'product_status',
        'primary_image',
        'gross_total',
        'packing_cost',
        'product_cost',
        'shipping_cost',
        'other_cost',
        'tax_percent',
        'total_cost',
        'discount_price',
        'discount_date_start',
        'discount_date_end',
        'meta_tag_title',
        'meta_tag_keyword',
        'meta_tag_description',
        'require_shipping',
        'shipping_width',
        'shipping_height',
        'shipping_length',
        'shipping_weight',
        'on_home',
        'on_deal',
        'deal_price',
        'deal_end_date',
        'deal_description',
    ];
    protected $hidden = [
        'updated_at', 'created_at'
    ];

    public function media()
    {
        return $this->belongsTo('App\Media', 'primary_image');
    }
}
