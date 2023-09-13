<?php

namespace App\Models;

use App\Models\SEOTool;
use App\Traits\CleanFiles;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AboutUs extends Model
{
    use HasFactory,CleanFiles,HasTranslations;

    public $fillable = ['company_name', 'description', 'creation_date', 'image', 'image_title', 'image_alt'];

    public $translatable = ['company_name', 'description'];
    public $filesFields = [];

    public $uniqueFiles = [
        'image' => [
            'formInputKey' => 'image',
        ],
    ];

    public $filesPath = 'about_us';

    /**
     * Translatable inputs for form creation
     */
    public static $translatableColumns = [
        'company_name' => [
            'type'          => 'text',
            'validations'   => 'required|string|max:30',
            'is_textarea'   => false,
        ],
        'description' => [
            'type'          => 'text',
            'validations'   => 'required|string|max:30',
            'is_textarea'   => true,
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
