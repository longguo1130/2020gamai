<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
Use \Carbon\Carbon;
use App\Product;
use App\productImages;
class Bid extends Model
{
    protected $table = 'bids';
    protected $dates = ['created_at','updated_at'];


     public function getDateFormat()
     {

 //        return 'Y-m-d H:i:s.u';
         return 'Y-m-d H:i:s.u';
     }

    public function scopeOwner($query){
        return $query->where('seller_id',\Auth::user()->id);
    }

    public function scopeBidding($query){
        return $query->where('status', 2)->orWhere('status',0);
    }
//    public function productInfo(){
//        return $this->hasOne('App\Product', 'id', 'product_id');
//    }

    public function buyerInfo(){
        return $this->hasOne('App\User','id','buyer_id');
    }
    public function sellerInfo(){
        return $this->hasOne('App\User','id','seller_id');
    }
    public function productInfo(){
        return $this->hasOne('App\Product','id','product_id');
    }

    public function getFeedback(){
         return $this->hasOne('App\Feedback','product_id','product_id');
    }

    public function getStatus(){
        if ($this->block == 1){
            return "group-blocked";
        }
        else{
            if($this->buyer_id==Auth::user()->id)
                return "group-selling";
            if($this->seller_id==Auth::user()->id)
                return "group-buying";

        }

    }

    public function getInfo(){
        if ($this->buyer_id==Auth::user()->id)
            return User::find($this->seller_id);
        elseif ($this->seller_id==Auth::user()->id)
            return User::find($this->buyer_id);
    }
    public function avatar(){
        if ($this->buyer_id==Auth::user()->id)
            return User::find($this->seller_id)->avatar;
        elseif ($this->seller_id==Auth::user()->id)
            return User::find($this->buyer_id)->avatar;
    }

}
