<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    
    protected $fillable = [
        'name','description','default','permissions'
    ];
    protected $hidden = [
        'updated_at', 'created_at'
    ];
    
     public function users()
       {
           return $this
               ->belongsToMany('App\User')
               ->withTimestamps();
       }
}
