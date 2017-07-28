<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Interest extends Model
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
     * @return App\InterestTranslation|null
     */
    public function interestTranslations()
    {
        return $this->hasMany('App\InterestTranslation');
    }
}
