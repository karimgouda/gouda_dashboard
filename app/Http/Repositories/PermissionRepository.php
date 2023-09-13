<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\PermissionInterface;
use App\Services\BaseEloquentService;
use App\Services\TranslatableService;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseEloquentService implements PermissionInterface
{

    protected $modelName = Permission::class;

    public function __construct()
    {
        $this->instance = $this->getNewInstance();
    }


    public function index($dataTable)
    {
        return $dataTable->render('backend.permissions.index');
    }


    public function create()
    {
        return view('backend.permissions.create');
    }


    public function store($request)
    {

        $this->executeSave($request->validated());

        return redirect()->route('roles.permissions.index')->with('success','Permission created successfully');
    }


    public function show($id)
    {
        $row = $this->findById($id);
        return view('backend.permissions.show', compact('row'));
    }


    public function edit($id)
    {
        $this->instance = $this->findById($id);
        $row = $this->instance;

        return view('backend.permissions.edit', compact('row'));
    }


    public function update($request, $id)
    {
        $this->instance = $this->findById($id);

        $this->executeSave($request->validated());

        return redirect()->route('roles.permissions.index')->with('success','Permission updated successfully');
    }


    public function destroy($id)
    {
        $this->delete($id);
        return redirect()->route('roles.permissions.index')->with('success','Permission deleted successfully');
    }

    public function bulkDestroy($ids)
    {
        $this->destroyAll($ids);
        return redirect()->route('roles.permissions.index')->with('success','permissions deleted successfully');
    }
}
