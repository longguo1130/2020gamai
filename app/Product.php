<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Bid;
use App\City;

class Product extends Model
{
    protected $table = 'products';
    protected $dates = ['created_at','updated_at'];

    public function images(){
    	return $this->hasMany('App\productImages','product_id','id');
    }

    public function cityInfo(){
        return $this->hasOne('App\City','id','city_id');
    }

    public function firstImage(){
    	return $this->hasOne('App\productImages','product_id','id')->latest();
    }

    public function bidsNum(){
       return $this->hasMany('App\Bid','product_id','id')->count();
    }


    public function singleImage(){
    	return $this->hasOne('App\productImages','product_id','id');
    }

   /* public function favorUser(){
        return $this->hasMany('App\Favorite','product_id','id');
    }*/

    public function favorites(){
        return $this->hasMany('App\Favorite','product_id','id');
    }

    // check it is checked as favorite
    public function is_favor($user_id){
        if(is_null($user_id)) return false;
        $product_id = $this->id;
        $favor = Favorite::where('user_id',$user_id)->where('product_id',$product_id)->first();
        return is_null($favor) ? false : true;
    }

    public function price_format($currency = 'PHP'){
        return $currency.' '.number_format($this->price);
    }
    public function created_date(){
        //return Carbon::parse($this->created_at)->diffForHumans();
        return $this->created_at->diffForHumans();
    }

    /* scopes */
    public function scopeOwner($query){
        return $query->where('user_id',Auth::user()->id);
    }
    public function scopeSelling($query){
        return $query->where('status', 0)->orWhere('status',2);
    }
    public function scopeSold($query){
        return $query->where('status', 1);
    }
}
