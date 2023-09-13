<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\TestimonialInterface;
use App\Models\Testimonial;
use App\Services\BaseEloquentService;
use App\Services\ImageService;
use App\Services\TranslatableService;

class TestimonialRepository extends BaseEloquentService implements TestimonialInterface
{
    protected $modelName = Testimonial::class;

    public function __construct()
    {
        $this->instance = $this->getNewInstance();
    }

    public function index($dataTable)
    {
        return $dataTable->render('backend.testimonial.index');
    }

    public function create()
    {
        return view('backend.testimonial.create');
    }

    public function store($request)
    {
        $requestData = $request->validated();
        if($request->hasFile('image')) $requestData = (new ImageService)->handleImageDetails(request: $request, imageKey: 'image', path: $this->instance->filesPath);
        $translatableFields    = TranslatableService::generateTranslatableFields($this->instance->getTranslatableFields(), $requestData);
        $nonTranslatableFields  = TranslatableService::getNonTranslatableFields($this->instance, $requestData);
        $data = array_merge($nonTranslatableFields, $translatableFields);
        $model = $this->executeSave($data);
        return redirect()->route('testimonial.index')->with('success','testimonial created successfully');
    }

    public function edit($id)
    {
        $this->instance = $this->findById($id);
        $row = TranslatableService::getTranslatableFields($this->instance->translatable, $this->instance);

        return view('backend.testimonial.edit', compact('row', 'id'));
    }

    public function update($request, $id)
    {
        $this->instance = $this->findById($id);

        $requestData = $request->validated();
        if($request->hasFile('image')) $requestData = (new ImageService)->handleImageDetails(request: $request, imageKey: 'image', path: $this->instance->filesPath);
        $translatableFields     = TranslatableService::generateTranslatableFields($this->instance->getTranslatableFields(), $requestData);
        $nonTranslatableFields  = TranslatableService::getNonTranslatableFields($this->instance, $requestData);
        $data = array_merge($nonTranslatableFields, $translatableFields);
        $model = $this->executeSave($data);
        return redirect()->route('testimonial.index')->with('success','testimonial Updated successfully');
    }

    public function destroy($id)
    {
        $this->instance = $this->findById($id);
        $this->delete($id);
        return redirect()->route('blogs.index')->with('success','blog deleted successfully');
    }


}
