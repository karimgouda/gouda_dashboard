<?php

namespace App\Models;

use App\Models\SEOTool;
use App\Traits\CleanFiles;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Policy extends Model
{
    use HasFactory,HasTranslations, CleanFiles;

    protected $guarded = [];

    protected $fillable = ['title', 'description', 'type'];

    public $filesFields = [''];

    public $filesPath = 'policies';

    public $translatable = ['title','description'];

    /**
     * Translatable inputs for form creation
     */
    public static $translatableColumns = [
        'title' => [
            'type'          => 'text',
            'validations'   => 'required|string',
            'is_textarea'   => false,
        ],
        'description' => [
            'type'          => 'text',
            'validations'   => 'required|string',
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
