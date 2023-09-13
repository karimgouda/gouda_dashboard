<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\BCategoryInterface;
use App\Models\BCategory;
use App\Services\BaseEloquentService;
use App\Services\TranslatableService;

class BCategoryRepository extends BaseEloquentService implements BCategoryInterface
{

    protected $modelName = BCategory::class;

    public function __construct()
    {
        $this->instance = $this->getNewInstance();
    }


    public function index($dataTable)
    {
        return $dataTable->render('backend.blogs.categories.index');
    }


    public function create()
    {
        return view('backend.blogs.categories.create');
    }


    public function store($request)
    {
        $translatableFields     = TranslatableService::generateTranslatableFields($this->instance->getTranslatableFields(), $request->validated());
        $this->executeSave($translatableFields);

        return redirect()->route('blogs.categories.index')->with('success','category created successfully');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $this->instance = $this->findById($id);
        $row = TranslatableService::getTranslatableFields($this->instance->translatable, $this->instance);
        return view('backend.blogs.categories.edit', compact('row'));
    }


    public function update($request, $id)
    {
        $this->instance = $this->findById($id);

        $translatableFields     = TranslatableService::generateTranslatableFields($this->instance->getTranslatableFields(), $request->validated());

        $this->executeSave($translatableFields);

        return redirect()->route('blogs.categories.index')->with('success','category updated successfully');
    }


    public function destroy($id)
    {
        $this->delete($id);
        return redirect()->route('blogs.categories.index')->with('success','category deleted successfully');
    }

    public function bulkDestroy($ids)
    {
        $this->destroyAll($ids);
        return redirect()->route('blogs.categories.index')->with('success','categories deleted successfully');
    }
}
