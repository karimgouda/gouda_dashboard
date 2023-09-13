<?php

namespace App\Http\Repositories;

use App\Models\Policy;
use App\Services\SEO\SEOToolsService;
use App\Services\BaseEloquentService;
use App\Services\TranslatableService;
use App\Http\Interfaces\PoliciesInterface;

class PoliciesRepository extends BaseEloquentService implements PoliciesInterface
{

    protected $modelName = Policy::class;

    public function __construct()
    {
        $this->instance = $this->getNewInstance();
    }


    public function index($dataTable)
    {
        return $dataTable->render('backend.policies.index');
    }


    public function create()
    {
        return view('backend.policies.create');
    }


    public function store($request)
    {
        $requestData = $request->validated();

        $translatableFields     = TranslatableService::generateTranslatableFields($this->instance->getTranslatableFields(), $requestData);
        $nonTranslatableFields  = TranslatableService::getNonTranslatableFields($this->instance, $requestData);

        $model = $this->executeSave(array_merge($nonTranslatableFields, $translatableFields));
        (SEOToolsService::withRequestAndModel($request, $model))->handleSEOToolsDetails();

        return redirect()->route('policies.index')->with('success','policy created successfully');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $this->instance = $this->findById($id);
        $row = TranslatableService::getTranslatableFields($this->instance->translatable, $this->instance);
        $row = array_merge($row, (new SEOToolsService)->getSEOFields($this->instance));
        return view('backend.policies.edit', compact('row'));
    }


    public function update($request, $id)
    {
        $this->instance = $this->findById($id);

        $requestData = $request->validated();

        $translatableFields     = TranslatableService::generateTranslatableFields($this->instance->getTranslatableFields(), $requestData);
        $nonTranslatableFields  = TranslatableService::getNonTranslatableFields($this->instance, $requestData);

        $model = $this->executeSave(array_merge($nonTranslatableFields, $translatableFields));
        (SEOToolsService::withRequestAndModel($request, $model))->updateRelatedSEOTool();

        return redirect()->route('policies.index')->with('success','policy updated successfully');
    }


    public function destroy($id)
    {
        $this->instance = $this->findById($id);
        (new SEOToolsService)->deleteRelatedSEOTool($this->instance);

        $this->delete($id);

        return redirect()->route('policies.index')->with('success','policy deleted successfully');
    }

    public function bulkDestroy($ids)
    {
        $this->destroyAll($ids);
        return redirect()->route('policies.index')->with('success','categories deleted successfully');
    }
}
