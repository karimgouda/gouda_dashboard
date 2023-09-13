<?php

namespace App\Http\Repositories;

use App\Models\Slider;
use App\Services\ImageService;
use App\Services\BaseEloquentService;
use App\Services\TranslatableService;
use App\Http\Interfaces\SlidersInterface;
use App\Models\SEOTool;
use App\Services\SEO\SEOToolsService;

class SlidersRepository extends BaseEloquentService implements SlidersInterface
{

    protected $modelName = Slider::class;

    public function __construct()
    {
        $this->instance = $this->getNewInstance();
    }


    public function index($dataTable)
    {
        return $dataTable->render('backend.sliders.index');
    }


    public function create()
    {
        return view('backend.sliders.create');
    }


    public function store($request)
    {
        $requestData = $request->validated();
        if($request->hasFile('image')) $requestData = (new ImageService)->handleImageDetails(request: $request, imageKey: 'image', path: $this->instance->filesPath);

        $translatableFields     = TranslatableService::generateTranslatableFields($this->instance->getTranslatableFields(), $requestData);
        $nonTranslatableFields  = TranslatableService::getNonTranslatableFields($this->instance, $requestData);

        $model = $this->executeSave(array_merge($nonTranslatableFields, $translatableFields));
        (SEOToolsService::withRequestAndModel($request, $model))->handleSEOToolsDetails();

        return redirect()->route('sliders.index')->with('success','slider created successfully');
    }


    public function show($id)
    {
        $row = $this->findById($id);
        return view('backend.sliders.show', compact('row'));
    }


    public function edit($id)
    {
        $this->instance = $this->findById($id);
        $row = TranslatableService::getTranslatableFields($this->instance->translatable, $this->instance);
        $row = array_merge($row, (new SEOToolsService)->getSEOFields($this->instance));

        return view('backend.sliders.edit', compact('row'));
    }


    public function update($request, $id)
    {
        $this->instance = $this->findById($id);

        $requestData = $request->validated();
        if($request->hasFile('image')) $requestData = (new ImageService)->handleImageDetails(request: $request, imageKey: 'image', path: $this->instance->filesPath);

        $translatableFields     = TranslatableService::generateTranslatableFields($this->instance->getTranslatableFields(), $requestData);
        $nonTranslatableFields  = TranslatableService::getNonTranslatableFields($this->instance, $requestData);

        $model = $this->executeSave(array_merge($nonTranslatableFields, $translatableFields));
        (SEOToolsService::withRequestAndModel($request, $model))->updateRelatedSEOTool();

        return redirect()->route('sliders.index')->with('success','slider updated successfully');
    }


    public function destroy($id)
    {
        $this->instance = $this->findById($id);
        (new SEOToolsService)->deleteRelatedSEOTool($this->instance);

        $this->delete($id);

        return redirect()->route('sliders.index')->with('success','slider deleted successfully');
    }

    public function bulkDestroy($ids)
    {
        $this->destroyAll($ids);
        return redirect()->route('sliders.index')->with('success','sliders deleted successfully');
    }
}
