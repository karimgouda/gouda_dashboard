<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ServicesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\ServicesInterface;
use App\Http\Requests\BulkDestroyRequest;
use App\Http\Requests\ServiceRequest;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ServicesController extends Controller
{
    private $servicesInterface;

    public function __construct(ServicesInterface $servicesInterface){
        $this->servicesInterface = $servicesInterface ;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ServicesDataTable $dataTable)
    {
        return $this->servicesInterface->index($dataTable);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->servicesInterface->show($id);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        return $this->servicesInterface->store($request);
    }

    public function create()
    {
        return $this->servicesInterface->create();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->servicesInterface->edit($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {
        return $this->servicesInterface->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->servicesInterface->destroy($id);
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
        return $this->servicesInterface->bulkDestroy($ids);
    }
}
