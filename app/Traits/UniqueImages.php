<?php

namespace App\Traits;

use App\Services\ImageService;
use Illuminate\Database\Eloquent\Model;


trait UniqueImages
{
    /**
     * Override the default behaviour
     */
    protected static function bootUniqueImages()
    {
        static::created(function (Model $model) {
            if(isset($model->uniqueFiles)) {
                foreach($model->uniqueFiles as $key => $value) {
                    $keyName = $value['formInputKey'];
                    if(request()->hasFile($keyName)) {
                        $requestData = (new ImageService)->handleImageDetails(request: request(), imageKey: $value['formInputKey'], path: $model->filesPath);
                        $model->update((array) $requestData);
                    }
                }
            }
        });

        static::updated(function (Model $model) {
            if(isset($model->uniqueFiles)) {
                foreach($model->uniqueFiles as $key => $value) {
                    $keyName = $value['formInputKey'];
                    if(request()->hasFile($keyName)) {
                        if(!is_null($model->getOriginal($keyName)) && ($model->getOriginal($keyName) != $model->$keyName) ) {
                            $requestData = (new ImageService)->handleImageDetails(request: request(), imageKey: $keyName, path: $model->filesPath);
                            $model->update((array) $requestData);
                        }
                    }
                }
            }
        });
    }
}
