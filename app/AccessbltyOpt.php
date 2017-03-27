<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class AccessbltyOpt extends Model
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
     */
    public function optionTranslations()
    {
        return $this->hasMany('App\AccessbltyOptTranslation');
    }
}