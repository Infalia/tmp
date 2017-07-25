<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'iso_code',
        'title',
    ];

    /**
     * The users that belong to the initiative.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
