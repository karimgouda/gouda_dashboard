<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\RoleInterface;
use App\Services\BaseEloquentService;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseEloquentService implements RoleInterface
{

    protected $modelName = Role::class;

    public function __construct()
    {
        $this->instance = $this->getNewInstance();
    }


    public function index($dataTable)
    {
        return $dataTable->render('backend.roles.index');
    }


    public function create()
    {
        $permissions = Permission::get();
        return view('backend.roles.create', compact('permissions'));
    }


    public function store($request)
    {

        $this->instance = $this->executeSave($request->validated());

        $this->instance->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success','role created successfully');
    }


    public function show($id)
    {
        $row = $this->findById($id);
        return view('backend.roles.show', compact('row'));
    }


    public function edit($id)
    {
        $this->instance = $this->findById($id);
        $row = $this->instance;
        $permissions = Permission::get();

        return view('backend.roles.edit', compact('row','permissions'));
    }


    public function update($request, $id)
    {
        $this->instance = $this->findById($id);

        $this->instance->syncPermissions($request->permissions);

        $this->executeSave($request->validated());

        return redirect()->route('roles.index')->with('success','role updated successfully');
    }


    public function destroy($id)
    {
        $this->delete($id);
        return redirect()->route('roles.index')->with('success','role deleted successfully');
    }

    public function bulkDestroy($ids)
    {
        $this->destroyAll($ids);
        return redirect()->route('roles.index')->with('success','roles deleted successfully');
    }
}
