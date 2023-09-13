<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\RoleInterface;
use App\Http\Requests\BulkDestroyRequest;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $RoleInterface;

    public function __construct(RoleInterface $RoleInterface){
        $this->RoleInterface = $RoleInterface ;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleDataTable $dataTable)
    {
        return $this->RoleInterface->index($dataTable);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->RoleInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        return $this->RoleInterface->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->RoleInterface->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->RoleInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        return $this->RoleInterface->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->RoleInterface->destroy($id);
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
        return $this->RoleInterface->bulkDestroy($ids);
    }
}
