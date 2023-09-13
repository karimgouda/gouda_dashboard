<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BCategory extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded = [];

    public $filesFields = [''];

    public $filesPath = '';

    public $translatable = ['name'];

    /**
     * Translatable inputs for form creation
     */
    public static $translatableColumns = [
        'name' => [
            'type'          => 'text',
            'validations'   => 'required|string|max:20',
            'is_textarea'   => false,
        ],
    ];


    /**
     * Return only the translatable fields of  section
     */
    public static function getTranslatableFields()
    {
        return array_keys(self::$translatableColumns);
    }

}
