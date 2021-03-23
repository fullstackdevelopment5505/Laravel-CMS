<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';  
    
     protected $fillable = [
        'module_name', 'write_access', 'module_constant', 'route_url', 'module_icon','order'
    ];
    
    protected $hidden = [
        'updated_at', 'created_at'
    ];

}
