<?php

namespace App\Http\Repositories;
use App\Http\Interfaces\ProfileInterface;
use App\Models\User;
use App\Services\BaseEloquentService;
use Illuminate\Support\Facades\Hash;

class ProfileRepository extends BaseEloquentService implements ProfileInterface
{
    protected $modelName = User::class;

    public function __construct()
    {
        $this->instance = $this->getNewInstance();
    }

    public function edit()
    {
        $this->instance = $this->instance->first();
        $row = $this->instance;

        return view('backend.profile.edit', compact('row'));
    }

    public function updateProfile($request)
    {
        $this->instance = $this->instance->first();

        $password = ($request->password) ? Hash::make($request->password) : $this->instance->password;

        $data = ['password' => $password] + $request->validated();

        $this->executeSave($data);

        return redirect()->back()->with('success','Profile Updated successfully');
    }
}
