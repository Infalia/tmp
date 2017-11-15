<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserArea extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'address',
        'neighbourhood',
        'suburb',
        'county',
        'city',
        'state',
        'country',
        'postcode',
        'latitude',
        'longitude',
    ];
}
