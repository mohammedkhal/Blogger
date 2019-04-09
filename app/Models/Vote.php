<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vote extends Model
{
    use Notifiable;

    public $table="votes" ;
    

    protected $casts = [
        'id' => 'BigInteger' , 
        'user_id' => 'BigInteger' , 
        'vote' => 'integer' , 
    ];

    protected $fillable = [
        'id','user_id','vote'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id' , 'id');
    }

    
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id' , 'id');
    }



 
}
