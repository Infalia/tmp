<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Position extends Model
{
    use Translatable;

    /**
     * Array with the fields translated in the Translation table.
     *
     * @var array
     */
    public $translatedAttributes = ['name'];

    /**
     * Get the translations for the option.
     *
     * @return App\PositionTranslation|null
     */
    public function positionTranslations()
    {
        return $this->hasMany('App\PositionTranslation');
    }
}
