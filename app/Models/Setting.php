<?php

namespace App\Models;

use App\Models\SEOTool;
use App\Traits\CleanFiles;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory,CleanFiles,HasTranslations;

    protected $guarded = [];

    public $filesFields = ['app_logo','app_logo_white','app_favicon'];

    public $filesPath = 'settings';

    public $translatable = [''];

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
