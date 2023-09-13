<?php

namespace App\Models;

use App\Traits\CleanFiles;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Slider extends Model
{
    use HasFactory,CleanFiles,HasTranslations;

    protected $guarded = ['image_name'];

    public $filesFields = [];

    public $uniqueFiles = [
        'image' => [
            'formInputKey' => 'image',
        ],
    ];

    public $filesPath = 'sliders';

    public $translatable = ['title'];

    /**
     * Translatable inputs for form creation
     */
    public static $translatableColumns = [
        'title' => [
            'type'          => 'text',
            'validations'   => 'required|string|max:30',
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

    /**
     * Get slider's SEO tool.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphOne;
     */
    public function seotool(): MorphOne
    {
        return $this->morphOne(SEOTool::class, 'seoable');
    }
}
