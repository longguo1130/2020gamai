<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moderator extends Model
{
    //
    protected $table = 'moderators';
    protected $dates = ['created_at','updated_at'];
}
