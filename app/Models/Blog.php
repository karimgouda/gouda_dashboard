<?php

namespace App\Models;

use App\Models\SEOTool;
use App\Traits\CleanFiles;
use App\Traits\UniqueImages;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory,CleanFiles,HasTranslations;

    protected $guarded = ['image_name'];

    public $filesFields = [];

    public $uniqueFiles = [
        'image' => [
            'formInputKey' => 'image',
        ],
    ];

    public $filesPath = 'blogs';

    public $translatable = ['title','sub_title','description','meta_title','meta_description'];

    /**
     * Translatable inputs for form creation
     */
    public static $translatableColumns = [
        'title' => [
            'type'          => 'text',
            'validations'   => 'required|string|max:30',
            'is_textarea'   => false,
        ],
        'sub_title' => [
            'type'          => 'text',
            'validations'   => 'required|string',
            'is_textarea'   => false,
        ],
        'description' => [
            'type'          => 'text',
            'validations'   => 'required|string',
            'is_textarea'   => true,
        ],
        'meta_title' => [
            'type'          => 'text',
            'validations'   => 'required|string|max:30',
            'is_textarea'   => false,
        ],
        'meta_description' => [
            'type'          => 'true',
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


    public function categories()
    {
        return $this->belongsToMany(BCategory::class, 'blog_categories', 'blog_id', 'category_id')->withPivot(['id', 'blog_id', 'category_id']);
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
