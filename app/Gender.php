<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Gender extends Model
{
    use Translatable;

    /**
     * Array with the fields translated in the Translation table.
     *
     * @var array
     */
    public $translatedAttributes = ['name'];

    /**
     * Get the translations for the category.
     *
     * @return App\GenderTranslation|null
     */
    public function genderTranslations()
    {
        return $this->hasMany('App\GenderTranslation');
    }
}
