<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'user_address';
    
    protected $fillable = [
        'user_id',
        'address_type', //home, work
        'contact_no',
        'address',
        'city',
        'state',
        'country',
        'zipcode',
        'default'
    ];
    protected $hidden = [
        'updated_at', 'created_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
