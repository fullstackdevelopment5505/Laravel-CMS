<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'page';
    
    protected $fillable = [
        'page_title',
        'page_description',
        'page_thumbnail', 
        'page_slug',      
        'meta_tag_title',
        'meta_tag_keyword',
        'meta_tag_description', 
        'default'       
    ];
    protected $hidden = [
        'updated_at', 'created_at'
    ];

    public function media()
    {
        return $this->belongsTo('App\Media', 'page_thumbnail');
    }

    public static function slugify($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
}
