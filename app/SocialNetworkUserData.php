<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SocialNetworkUserData extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id',
       'social_network_id',
       'user_id',
       'data',
       'since',
    ];
}
