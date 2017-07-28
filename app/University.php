<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class University extends Model
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
     * @return App\UniversityTranslation|null
     */
    public function universityTranslations()
    {
        return $this->hasMany('App\UniversityTranslation');
    }
}
