<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paypal extends Model
{
    //
    protected $table = 'paypal_account';
    public $fillable = ['id','user_id','amount','details'];
}
