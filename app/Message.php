<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\productImages;
class Message extends Model
{
    protected $table = 'messages';

    public function fromUser(){
        return $this->hasOne('App\User','id','from_user');
    }

    public function toUser(){
        return $this->hasOne('App\User','id','to_user');
    }


}
