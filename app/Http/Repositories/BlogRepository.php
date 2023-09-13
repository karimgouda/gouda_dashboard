<?php

namespace App\Http\Repositories;

use App\Models\Blog;
use Illuminate\Support\Arr;
use App\Services\ImageService;
use App\Services\SEO\SEOToolsService;
use App\Services\BaseEloquentService;
use App\Services\TranslatableService;
use App\Http\Interfaces\BlogInterface;
use App\Http\Interfaces\BCategoryInterface;

class BlogRepository extends BaseEloquentService implements BlogInterface
{

    protected $modelName = Blog::class;

    public function __construct()
    {
        $this->instance = $this->getNewInstance();
    }


    public function index($dataTable)
    {
        return $dataTable->render('backend.blogs.index');
    }


    public function create()
    {
        $categories =   app()->make(BCategoryInterface::class)->getAll();
        return view('backend.blogs.create',compact('categories'));
    }


    public function store($request)
    {
        $requestData = $request->validated();
        if($request->hasFile('image')) $requestData = (new ImageService)->handleImageDetails(request: $request, imageKey: 'image', path: $this->instance->filesPath);

        $requestData['tags'] = json_encode(explode(',',$requestData['tags']));
        $requestData['is_publish'] = isset($requestData['is_publish']) ? 1 : 0;

        $translatableFields    = TranslatableService::generateTranslatableFields($this->instance->getTranslatableFields(), $requestData);
        $nonTranslatableFields  = TranslatableService::getNonTranslatableFields($this->instance, $requestData);
        $data = array_merge($nonTranslatableFields, $translatableFields);
        $model = $this->executeSave(Arr::except($data, 'categories'));
        if(isset($data['categories'])){
            $model->categories()->sync($data['categories']);
        }
        (SEOToolsService::withRequestAndModel($request, $model))->handleSEOToolsDetails();

        return redirect()->route('blogs.index')->with('success','blog created successfully');
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $this->instance  = $this->findById($id,['categories']);

        $blog_categories = $this->instance->categories;
        $row = TranslatableService::getTranslatableFields($this->instance->translatable, $this->instance);
        $row = array_merge($row, (new SEOToolsService)->getSEOFields($this->instance));
        $categories =   app()->make(BCategoryInterface::class)->getAll();

        return view('backend.blogs.edit', compact('row','categories','blog_categories'));
    }


    public function update($request, $id)
    {
        $this->instance = $this->findById($id);

        $requestData = $request->validated();
        if($request->hasFile('image')) $requestData = (new ImageService)->handleImageDetails(request: $request, imageKey: 'image', path: $this->instance->filesPath);

        $requestData['tags'] = json_encode(explode(',',$requestData['tags']));
        $requestData['is_publish'] = isset($requestData['is_publish']) ? 1 : 0;

        $translatableFields     = TranslatableService::generateTranslatableFields($this->instance->getTranslatableFields(), $requestData);
        $nonTranslatableFields  = TranslatableService::getNonTranslatableFields($this->instance, $requestData);
        $data = array_merge($nonTranslatableFields, $translatableFields);

        $model = $this->executeSave(Arr::except($data, 'categories'));
        if(isset($data['categories'])){
            $model->categories()->sync($data['categories']);
        }
        (SEOToolsService::withRequestAndModel($request, $model))->updateRelatedSEOTool();

        return redirect()->route('blogs.index')->with('success','blog updated successfully');
    }


    public function destroy($id)
    {
        $this->instance = $this->findById($id);
        (new SEOToolsService)->deleteRelatedSEOTool($this->instance);

        $this->delete($id);
        return redirect()->route('blogs.index')->with('success','blog deleted successfully');
    }

    public function bulkDestroy($ids)
    {
        $this->destroyAll($ids);
        return redirect()->route('blogs.index')->with('success','blogs deleted successfully');
    }
}
