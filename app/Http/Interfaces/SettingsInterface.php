<?php

namespace App\Http\Interfaces;

interface SettingsInterface
{
    public function index();
    public function store($request);
    public function updateSettings($request);
    public function destroy($id);
}
