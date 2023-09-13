<?php

namespace App\Http\Interfaces;

interface AuthenticationInterface
{
    public function show();
    public function login($request);
    public function logout();
}
