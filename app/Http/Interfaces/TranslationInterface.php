<?php

namespace App\Http\Interfaces;

use App\Interfaces\BaseInterface;

interface TranslationInterface
{
    public function index();

    public function show($dataTable,$lang);

    public function update($request, $id);

}
