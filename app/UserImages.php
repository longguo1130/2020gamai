<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserImages extends Model
{
    protected $table = 'userimages';

    protected $fillable = ['name','extension','path'];
}
