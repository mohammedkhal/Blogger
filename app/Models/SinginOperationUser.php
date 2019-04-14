<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SinginOperationUser extends Model
{

    public $table="singin_operation_users" ;

    protected $casts = [
     'id' =>'integer' ,
     'admin_id' =>'integer',
     'ip' =>'string',
     'country' =>'string',
     'device_type' =>'string',
     'browser' =>'string',
     'operating_system' =>'string',
     
    ];

    public $timestamps = false;


    protected $fillable = [
        'id', 'writer_id' , 'ip', 'country', 'device_type' ,
        'browser' , 'operating_system' , 'signin' , 'signout' , 'expire' 
    ];

    
    protected $dates = [
        'signin',
        'signout',
        'expire',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User' , 'user_id' , 'id');
    }

 
}
