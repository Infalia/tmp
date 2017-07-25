<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the details record associated with the user.
     *
     * @return App\UserDetail|null
     */
    public function userDetails()
    {
        return $this->hasOne('App\UserDetail');
    }

    /**
     * Get the gender record associated with the user.
     *
     * @return App\Gender|null
     */
    public function gender()
    {
        return $this->hasOne('App\Gender');
    }

    /**
     * The languages that belong to the user.
     *
     * @return App\Language|null
     */
    public function languages()
    {
        return $this->belongsToMany('App\Language');
    }

    /**
     * The accessibility options that belong to the user.
     *
     * @return App\AccessbltyOpt|null
     */
    public function accessibilityOptions()
    {
        return $this->belongsToMany('App\AccessbltyOpt');
    }

    /**
     * The initiatives that belong to the user.
     *
     * @return App\Initiative|null
     */
    public function initiatives()
    {
        return $this->hasMany('App\Initiative');
    }

    /**
     * Get user comments.
     *
     * @return App\Comment|null
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * The roles that belong to the user.
     *
     * @return App\SocialNetwork|null
     */
    public function socialNetworks()
    {
        return $this->belongsToMany('App\SocialNetwork');
    }
}
