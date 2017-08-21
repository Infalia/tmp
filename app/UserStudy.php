<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStudy extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'institute_name',
        'studies_name',
        'city_name',
    ];
}
