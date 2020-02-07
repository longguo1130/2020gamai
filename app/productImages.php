<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $table = 'productimages';

    protected $fillable = ['name','extension','path'];
}
