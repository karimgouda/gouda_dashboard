<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BCategoryDataTable;
use App\DataTables\PoliciesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\PoliciesInterface;
use App\Http\Requests\BulkDestroyRequest;
use App\Http\Requests\PoliciesRequest;

class PoliciesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $PoliciesInterface;

    public function __construct(PoliciesInterface $PoliciesInterface){
        $this->PoliciesInterface = $PoliciesInterface ;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PoliciesDataTable $dataTable)
    {
        return $this->PoliciesInterface->index($dataTable);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->PoliciesInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PoliciesRequest $request)
    {
        return $this->PoliciesInterface->store($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->PoliciesInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PoliciesRequest $request, $id)
    {
        return $this->PoliciesInterface->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->PoliciesInterface->destroy($id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bulkDestroy(BulkDestroyRequest $request)
    {
        $ids = $request->ids;
        return $this->PoliciesInterface->bulkDestroy($ids);
    }
}
