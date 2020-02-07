<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Favorite extends Model
{
    protected $table = 'favorites';

    public $timestamps = false;

    public function scopeOwner($query){
        return $query->where('user_id',Auth::user()->id);
    }

    public function productInfo(){

       return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
