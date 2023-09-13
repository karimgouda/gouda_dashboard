<?php

namespace App\Http\Interfaces;

interface ProfileInterface
{
    public function edit();
    public function updateProfile($request);
}
