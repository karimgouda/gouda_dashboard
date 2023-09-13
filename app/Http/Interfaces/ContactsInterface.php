<?php

namespace App\Http\Interfaces;

use App\Interfaces\BaseInterface;

interface ContactsInterface
{
    public function index($dataTable);
    public function show($id);
    public function store($request);
    public function updateStatus($id,$status);
    public function destroy($id);
    public function bulkDestroy($ids);
}
