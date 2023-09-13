<?php

namespace App\Http\Repositories;

use App\Models\User;
use App\Services\ImageService;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Services\BaseEloquentService;
use App\Services\TranslatableService;
use App\Http\Interfaces\UserInterface;

class UserRepository extends BaseEloquentService implements UserInterface
{

    protected $modelName = User::class;

    public function __construct()
    {
        $this->instance = $this->getNewInstance();
    }


    public function index($dataTable)
    {
        return $dataTable->render('backend.users.index');
    }


    public function create()
    {
        $roles = Role::get();
        return view('backend.users.create',compact('roles'));
    }


    public function store($request)
    {
        $requestData = $request->validated();
        if($request->hasFile('image')) $requestData = (new ImageService)->handleImageDetails(request: $request, imageKey: 'image', path: $this->instance->filesPath);

        $nonTranslatableFields  = TranslatableService::getNonTranslatableFields($this->instance, $requestData);

        $user = $this->executeSave(array_merge($nonTranslatableFields,['password' => Hash::make($request->password)]));

        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('success','User created successfully');
    }


    public function show($id)
    {
        $row = $this->findById($id);
        return view('backend.users.show', compact('row'));
    }


    public function edit($id)
    {
        $this->instance = $this->findById($id,['roles']);
        $row = TranslatableService::getTranslatableFields($this->instance->translatable, $this->instance);
        $roles = Role::get();

        return view('backend.users.edit', compact('row','roles'));
    }


    public function update($request, $id)
    {
        $this->instance = $this->findById($id);

        $requestData = $request->validated();
        if($request->hasFile('image')) $requestData = (new ImageService)->handleImageDetails(request: $request, imageKey: 'image', path: $this->instance->filesPath);

        $nonTranslatableFields  = TranslatableService::getNonTranslatableFields($this->instance, $requestData);

        $password = ($request->password) ? ['password' => Hash::make($request->password)] : ['password' => $this->instance->password];

        $user = $this->executeSave(array_merge($nonTranslatableFields,$password));

        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('success','User updated successfully');
    }


    public function destroy($id)
    {
        $this->delete($id);
        return redirect()->route('users.index')->with('success','User deleted successfully');
    }

    public function bulkDestroy($ids)
    {
        $this->destroyAll($ids);
        return redirect()->route('users.index')->with('success','users deleted successfully');
    }
}
