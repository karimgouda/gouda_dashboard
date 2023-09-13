<?php

namespace App\Services\SEO;

use App\Models\SEOTool;
use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Services\FileService;
use Illuminate\Database\Eloquent\Model;

class SEOToolsService
{
    /**
     * List of SEO tools form input names and validations
     */
    protected $seoInputs = [

        // Open Graph Validations
        'og_type'               => 'nullable|string',
        'og_title'              => 'nullable|string|max:65',
        'og_url'                => 'nullable|string',
        'og_image'              => 'image|mimes:jpeg,png,jpg,gif,webp,svg',
        'og_description'        => 'nullable|string|max:155',

        // Twitter Card Validations
        'twitter_card'          => 'nullable|string',
        'twitter_title'         => 'nullable|string|max:65',
        'twitter_site'          => 'nullable|string',
        'twitter_description'   => 'nullable|string|max:155',
        'twitter_image'         => 'image|mimes:jpeg,png,jpg,gif,webp,svg',
        'twitter_image_alt'     => 'nullable|string',
    ];

    /**
     * List of SEO tools inputs of files type
     */
    private $inputFiles = [
        'og_image',
        'twitter_image'
    ];

    /**
     * Request data for the sent validated request data
     */
    private $requestData;

    /**
     * A model to attach the record of SEO Tools to it
     */
    private $model;


    /**
     * Class default empty constructor
     */
    public function __construct() { }

    /**
     * Multiple constructor with request and model restriction
     *
     * @param Illuminate\Http\Request $request
     * @return self
     */
    public static function withRequestAndModel(Request $request, Model $model) : self
    {
        $instance = new self();
        $instance->requestData = $request->validated();
        $instance->model = $model;

        return $instance;
    }

    /**
     * Multiple constructor with only request restriction
     *
     * @param Illuminate\Http\Request $request
     * @return self
     */
    public static function withRequest(Request $request) : self
    {
        $instance = new self();
        $instance->requestData = $request->all();

        return $instance;
    }


    /**
     * Handle the entire process for storing SEO Tools details
     *
     * @return bool a flag to determine whether the process of storing SEO Tools and associate it to model reached successfully
     */
    public function handleSEOToolsDetails() : bool
    {
        if($this->anySEOInputIsFilled($this->requestData)) {

            $this->uploadSEOToolsImages();
            $this->createSEOToolRecord();
            return true;
        }

        return false;
    }

    /**
     * Delete related SEO tool from the SEOTool model itself to make the boot deleted method be triggered
     *
     * @param Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function deleteRelatedSEOTool(Model $model) : void
    {
        if(isset($model->seotool)) SEOTool::destroy($model->seotool->id);
    }

    /**
     * A getter for SEO tools validation rules
     *
     * @return array
     */
    public function getSEOToolsValidationRules() : array
    {
        return $this->seoInputs;
    }

    /**
     * Get array of the sent model columns and its related SEO Tool columns
     *
     * @param Illuminate\Database\Eloquent\Model $model
     * @return array
     */
    public function getSEOFields(Model $model) : array
    {
        return isset($model) ? array_merge($model->toArray(), isset($model->seotool) ? Arr::except($model->seotool->toArray(), ['id']) : [] ) : [];
    }

    /**
     * Update the related SEO Tool record of the sent model
     *
     * @return bool
     */
    public function updateRelatedSEOTool() : bool
    {
        if($this->anySEOInputIsFilled($this->requestData)) {

            $this->uploadSEOToolsImages();

            if(isset($this->model->seotool) ) $this->model->seotool->update($this->requestData);
            return true;
        }

        return false;
    }

    /**
     * Update or create related SEO tool record which associated with a single record.
     *
     * @return bool
     */
    public function handleSingleSEOTool() : bool
    {
        if($this->anySEOInputIsFilled($this->requestData)) {
            $this->uploadSEOToolsImages();
            if(isset($this->model->seotool)) SEOTool::firstWhere('id', $this->model->seotool->id)->update($this->requestData);
            return true;
        }

        return false;
    }

    /**
     * Handle the update or create for SEO Tool record which related to the setting table with caring about updated boot method model.
     *
     * @param array $data The old request converted data such as translatable data and its images
     * @return array
     */
    public function handleSettingSEOTools(array $data) : array
    {
        // Set the model to ignore needed filepath issue
        $this->model = (new Setting);

        if($this->anySEOInputIsFilled($this->requestData)) {
            $this->uploadSEOToolsImages();
            SEOTool::where('is_for_setting', true)->exists() ? SEOTool::firstWhere('is_for_setting', true)->update($this->requestData) : SEOTool::create(array_merge($this->requestData, ['is_for_setting' => true]));
        }

        return $this->isolateSEOTools($data);
    }


    /**
     * Create new record for seotools table attached with its relevant model.
     *
     * @return void
     */
    private function createSEOToolRecord() : void
    {
        $seoToolRecord = SEOTool::create($this->requestData);
        $this->model->seotool()->save($seoToolRecord);
    }

    /**
     * Handle the upload process of any image file related to SEO Tools
     *
     * @return void
     */
    private function uploadSEOToolsImages() : void
    {
        foreach($this->inputFiles as $inputFileKey) {
            if(isset($this->requestData[$inputFileKey])) {
                $file = $this->requestData[$inputFileKey];
                $this->requestData[$inputFileKey] = FileService::savePublicFile($file, (new SEOTool)->filesPath . '/' . $this->model->filesPath);
            }
        }
    }

    /**
     * Check if any input from SEO Tools type is sent and filled in the request
     *
     * @param array $data
     * @return bool A flag to determine if any input from SEO Tools type is filled or not
     */
    private function anySEOInputIsFilled(array $data) : bool
    {
        $isFilled = false;

        foreach(array_keys($this->seoInputs) as $seoInputKey) {
            if(isset($data[$seoInputKey]) && !empty($data[$seoInputKey]) ) {
                $isFilled = true;
            }
        }

        return $isFilled;
    }

    /**
     * Delete the seo inputs from the given array
     *
     * @param array $data
     * @return array
     */
    private function isolateSEOTools(array $data) : array
    {
        foreach(array_keys($this->seoInputs) as $key) {
            if(isset($data[$key])) unset($data[$key]);
        }

        return $data;
    }

}
