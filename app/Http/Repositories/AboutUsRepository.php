<?php

namespace App\Http\Repositories;
use App\Models\AboutUs;
use App\Services\ImageService;
use App\Services\SEO\SEOToolsService;
use App\Services\BaseEloquentService;
use App\Services\TranslatableService;
use App\Http\Interfaces\AboutUsInterface;

class AboutUsRepository extends BaseEloquentService implements AboutUsInterface
{
    protected $modelName = AboutUs::class;

    public function __construct()
    {
        $this->instance = $this->getNewInstance();
    }

    public function edit()
    {
        $this->instance = AboutUs::first();
        $row = TranslatableService::getTranslatableFields($this->instance->translatable, $this->instance);
        $row = array_merge($row, (new SEOToolsService)->getSEOFields($this->instance));

        return view('backend.about-us.edit', compact('row'));
    }

    public function update($request,$id)
    {
        $this->instance = AboutUs::first();

        $requestData = $request->validated();
        if($request->hasFile('image')) $requestData = (new ImageService)->handleImageDetails(request: $request, imageKey: 'image', path: $this->instance->filesPath);

        $translatableFields     = TranslatableService::generateTranslatableFields($this->instance->getTranslatableFields(), $requestData);
        $nonTranslatableFields  = TranslatableService::getNonTranslatableFields($this->instance, $requestData);
        $this->instance = AboutUs::first();

        $requestData = $request->validated();
        if($request->hasFile('image')) $requestData = (new ImageService)->handleImageDetails(request: $request, imageKey: 'image', path: $this->instance->filesPath);

        $translatableFields     = TranslatableService::generateTranslatableFields($this->instance->getTranslatableFields(), $requestData);
        $nonTranslatableFields  = TranslatableService::getNonTranslatableFields($this->instance, $requestData);

        $model = $this->executeSave(array_merge($nonTranslatableFields, $translatableFields));
        (SEOToolsService::withRequestAndModel($request, $model))->handleSingleSEOTool();

        return redirect()->back()->with('success','About Us Updated successfully');

        $model = $this->executeSave(array_merge($nonTranslatableFields, $translatableFields));
        (SEOToolsService::withRequestAndModel($request, $model))->handleSingleSEOTool();

        return redirect()->back()->with('success','About Us Updated successfully');
    }
}
