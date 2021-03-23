<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'config_setting';
    
    protected $fillable = [
        'config_title','config_value'
    ]; 
    
    protected $hidden = [
        'updated_at', 'created_at'
    ];

}
