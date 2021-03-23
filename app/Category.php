<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    
    protected $fillable = [
        'category_name','category_url', 'parent_id', 'status', 'media_id'
    ];
    protected $hidden = [
        'updated_at', 'created_at'
    ];

    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id','id')->
        join('media', 'category.media_id', '=', 'media.id')->
        select('category.*','media.media_url');
    }

    public function getChildren() {
        $children = $this->hasMany('App\Category','parent_id');
        foreach($children as $child) {
            $child->mom = $this;
        }
        return  $children;
    }

    public function getParent() {
        $mother = $this->belongsTo('App\Category','parent_id');
        if(isset($mother->kids)) {
            $mother->kids->merge($mother);
        }
        return $mother;
    }
}
