<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\AboutUsInterface;
use App\Http\Requests\AboutUsRequest;
use App\Models\AboutUs;

class AboutUsController extends Controller
{
    private $servicesInterface;

    public function __construct(AboutUsInterface $servicesInterface){
        $this->servicesInterface = $servicesInterface ;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return $this->servicesInterface->edit();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(AboutUsRequest $request)
    {
        $about_us = AboutUs::first(['id']);
        return $this->servicesInterface->update($request, $about_us->id);
    }

}
