<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class AccessbltyCat extends Model
{
    use Translatable;

    /**
     * Array with the fields translated in the Translation table.
     *
     * @var array
     */
    public $translatedAttributes = ['name'];


    /**
     * Get the options for the category.
     */
    public function categoryOptions()
    {
        return $this->hasMany('App\AccessbltyOpt');
    }

    /**
     * Get the translations for the category.
     */
    public function categoryTranslations()
    {
        return $this->hasMany('App\AccessbltyCatTranslation');
    }
}
