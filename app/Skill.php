<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Skill extends Model
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
     * @return App\SkillTranslation|null
     */
    public function skillTranslations()
    {
        return $this->hasMany('App\SkillTranslation');
    }
}
