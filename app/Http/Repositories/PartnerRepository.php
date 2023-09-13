<?php

namespace App\Http\Repositories;
use App\Http\Interfaces\PartnerInterface;
use App\Models\Partner;
use App\Services\BaseEloquentService;
use App\Services\TranslatableService;

class PartnerRepository extends BaseEloquentService implements PartnerInterface
{
    protected $modelName = Partner::class;

    public function __construct()
    {
        $this->instance = $this->getNewInstance();
    }


    public function index($dataTable)
    {
        return $dataTable->render('backend.partners.index');
    }

    public function create()
    {
        return view('backend.partners.create');
    }
    public function show($id)
    {
        //
    }
    public function store($request)
    {
        $data  = TranslatableService::getNonTranslatableFields($this->instance, $request->validated());
        $this->executeSave($data);

        return redirect()->route('partners.index')->with('success','Service created successfully');
    }

    public function edit($id)
    {
        $this->instance = $this->findById($id);
        $row = TranslatableService::getTranslatableFields($this->instance->translatable, $this->instance);

        return view('backend.partners.edit', compact('row', 'id'));
    }


    public function update($request, $id)
    {
        $this->instance = $this->findById($id);

        $data  = TranslatableService::getNonTranslatableFields($this->instance, $request->validated());
        $this->executeSave($data);

        return redirect()->route('partners.index')->with('success','partner updated successfully');
    }

    public function destroy($id)
    {
        $this->delete($id);
        return redirect()->route('partners.index')->with('success','partner deleted successfully');
    }

    public function bulkDestroy($ids)
    {
        $this->destroyAll($ids);
        return redirect()->route('partners.index')->with('success','partners deleted successfully');
    }
}
