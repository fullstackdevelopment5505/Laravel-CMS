<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';  
    
     protected $fillable = [
        'media_url', 'title', 'file_name', 'file_type'
    ];
    
    protected $hidden = [
        'updated_at', 'created_at'
    ];

}
