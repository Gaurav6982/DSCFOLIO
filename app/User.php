<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function info(){
        return $this->hasOne('App\UserInfo','user_id','id');
    }
    public function link_set_1(){
        return $this->hasMany('App\LinkSet','user_id','id')->where('link_set_num',1);
    }
    public function link_set_2(){
        return $this->hasMany('App\LinkSet','user_id','id')->where('link_set_num',2);
    }
    public function social(){
        return $this->hasMany('App\SocialLinks','user_id','id');
    }
}
