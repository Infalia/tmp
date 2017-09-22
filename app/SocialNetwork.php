<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'image',
        'class_name',
        'priority',
    ];


    /**
     * The users that belong to the social network.
     *
     * @return App\User|null
     */
    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('profile_info', 'token', 'token_expire', 'network_user_id', 'updated_at');
    }

    /**
     * The social network data that belong to the network.
     *
     * @return App\SocialNetworkUserData|null
     */
    public function socialNetworkData()
    {
        return $this->belongsToMany('App\User', 'social_network_user_data', 'social_network_id', 'user_id')->withPivot('data', 'since', 'updated_at')->using('App\SocialNetworkUserData');
    }
}
