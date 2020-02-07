<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\productImages;
class Feedback extends Model
{
    protected $table = 'feedback';

    public function created_date(){
        //return Carbon::parse($this->created_at)->diffForHumans();
        return $this->created_at->diffForHumans();
    }

    public function toUser(){
        return $this->hasOne('App\User','id','from_user');
    }
    public function fromUser(){
        return $this->hasOne('App\User','id','to_user');
    }

    public function productInfo(){
        return $this->hasOne('App\Product','id','product_id');
    }
}
