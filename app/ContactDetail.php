<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    protected $table = 'contact_detail';
    
    protected $fillable = [
        'contact_name','contact_email','message'
    ];
    protected $hidden = [
        'updated_at', 'created_at'
    ];
    
    
}
