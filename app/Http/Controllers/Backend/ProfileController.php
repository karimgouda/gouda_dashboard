<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\ProfileInterface;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    private $ProfileInterface;

    public function __construct(ProfileInterface $ProfileInterface){
        $this->ProfileInterface = $ProfileInterface ;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return $this->ProfileInterface->edit();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(ProfileRequest $request)
    {
        return $this->ProfileInterface->updateProfile($request);
    }

}
