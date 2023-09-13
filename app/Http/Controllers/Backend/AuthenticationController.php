<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\AuthenticationInterface;
use App\Http\Requests\LoginRequest;

class AuthenticationController extends Controller
{

    private $AuthenticationInterface;

    public function __construct(AuthenticationInterface $AuthenticationInterface){
        $this->AuthenticationInterface = $AuthenticationInterface ;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return $this->AuthenticationInterface->show();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        return $this->AuthenticationInterface->login($request);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        return $this->AuthenticationInterface->logout();
    }

}
