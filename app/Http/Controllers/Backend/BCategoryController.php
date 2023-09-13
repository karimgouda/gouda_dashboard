<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\BCategoryInterface;
use App\Http\Requests\BulkDestroyRequest;
use App\Http\Requests\BCategoryRequest;

class BCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $BCategoryInterface;

    public function __construct(BCategoryInterface $BCategoryInterface){
        $this->BCategoryInterface = $BCategoryInterface ;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BCategoryDataTable $dataTable)
    {
        return $this->BCategoryInterface->index($dataTable);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->BCategoryInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BCategoryRequest $request)
    {
        return $this->BCategoryInterface->store($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->BCategoryInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BCategoryRequest $request, $id)
    {
        return $this->BCategoryInterface->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->BCategoryInterface->destroy($id);
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
        return $this->BCategoryInterface->bulkDestroy($ids);
    }
}
