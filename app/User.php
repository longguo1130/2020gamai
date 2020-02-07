<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deposit','name', 'username', 'email', 'password', 'provider', 'provider_id', 'city_id','avatar','mobile','fullname','address','verify_status','bid_count','transaction_count','update_count','valid_id_status','valid_id'
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

    public function location(){
        return $this->hasOne('App\City','id','city_id');
    }

    public function profileImage(){
        return $this->hasOne('App\UserImages','user_id','id')->first();
    }
    public static function isAdmin()
    {
        return ($user = auth()->user()) && $user->user_role==1;
    }
    public function created_date(){
        //return Carbon::parse($this->created_at)->diffForHumans();
        return $this->created_at->diffForHumans();
    }
}
