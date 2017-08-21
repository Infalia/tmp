<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPosition extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'company_name',
        'position_name',
        'city_name',
        'start_date',
        'end_date',
        'is_current',
    ];
}
