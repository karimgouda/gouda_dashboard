<?php

namespace App\Models;

use App\Traits\CleanFiles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SEOTool extends Model
{
    use HasFactory, CleanFiles;

    public $table = 'seotools';

    public $filesFields = ['og_image', 'twitter_image'];

    /**
     * Name of directory to store all of uploaded seo tools files
     */
    public $filesPath = 'seotools';

    protected $fillable = [

        // Open Graph Columns
        'og_type'               ,
        'og_title'              ,
        'og_url'                ,
        'og_image'              ,
        'og_description'        ,

        // Twitter Card Columns
        'twitter_card'          ,
        'twitter_title'         ,
        'twitter_site'          ,
        'twitter_description'   ,
        'twitter_image'         ,
        'twitter_image_alt'     ,

        // Setting Flag
        'is_for_setting'        ,
    ];

    /**
     * Get the parent seoable model.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphTo;
     */
    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }
}
