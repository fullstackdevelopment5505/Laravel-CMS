<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    protected $table = 'addon';  
    
     protected $fillable = [
        'add_on_name','add_on_constant', 'status', 'admin_route','admin_route_param'
    ];
    
    protected $hidden = [
        'updated_at', 'created_at'
    ];

}
