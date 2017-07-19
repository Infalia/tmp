<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Initiative extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'initiative_type_id',
        'title',
        'description',
        'latitude',
        'longitude',
        'input_map_data',
        'start_date',
        'end_date',
    ];

    /**
     * The initiative type.
     *
     * @return App\InitiativeType|null
     */
    public function initiativeType()
    {
        return $this->belongsTo('App\InitiativeType');
    }

    /**
     * The user.
     *
     * @return App\User|null
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The users that belong to the initiative.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * The initiative images.
     *
     * @return App\InitiativeImage|null
     */
    public function images()
    {
        return $this->hasMany('App\InitiativeImage');
    }

    /**
     * Get initiative comments.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
