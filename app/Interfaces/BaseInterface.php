<?php

namespace App\Interfaces;

interface BaseInterface
{
    public function index($dataTable);

    public function create();

    public function store($request);

    public function show($id);

    public function edit($id);

    public function update($request, $id);

    public function destroy($id);

    public function bulkDestroy($ids);
}
