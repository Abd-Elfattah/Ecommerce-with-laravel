<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname' ,'email', 'password', 'is_admin' , 'verifyToken' , 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function addresses(){
        return $this->hasMany('App\Address');
    }


    public function payments(){
        return $this->hasMany('App\Payment');
    }

    public function orders(){
        return $this->hasManyThrough('App\Order' , 'App\Payment');
    }

    public function rating(){
        return $this->hasOne('App\Rating');
    }



    // Admin Middleware
    public function isAdmin(){
        if($this->is_admin == 1 ){
            return true;
        }
        return false;
    }
}
