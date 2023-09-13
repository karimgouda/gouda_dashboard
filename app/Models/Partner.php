<?php

namespace App\Models;

use App\Traits\CleanFiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Partner extends Model
{
    use HasFactory,CleanFiles,HasTranslations;

    protected $guarded = [];

    public $filesFields = ['image'];

    public $filesPath = 'partners';

    public $translatable = [];

    /**
     * Translatable inputs for form creation
     */
    public static $translatableColumns = [];


    /**
     * Return only the translatable fields of  section
     */
    public static function getTranslatableFields()
    {
        return array_keys(self::$translatableColumns);
    }
}
