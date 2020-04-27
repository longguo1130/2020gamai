<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    //
     protected $table = 'useraccounts';
     protected $fillable = ['id','firstName','middleName','lastName','city','country','street','house_number','town','province','zipcode','birthday','valid_id','account_status','update_count'];
}
