<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'continent_name',
        'country_name',
        'subdivision_name',
        'name',
    ];
}
