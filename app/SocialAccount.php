<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $guarded = [];
    protected $table = 'social_accounts';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
