<?php

namespace Textla\Review;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $table = 'product_review';  
    
     protected $fillable = [
        'user_id',
        'rating_star', 
        'order_id',
        'review_person_name', 
        'review_comment',
        'product_id', 
        'show_home', 
        'status'
    ];
    
    protected $hidden = [
        'updated_at', 'created_at'
    ];

}
