<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PartnerDataTable;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\PartnerInterface;
use App\Http\Requests\BulkDestroyRequest;
use App\Http\Requests\PartnerRequest;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PartnerController extends Controller
{
    private $PartnerInterface;

    public function __construct(PartnerInterface $PartnerInterface){
        $this->PartnerInterface = $PartnerInterface ;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PartnerDataTable $dataTable)
    {
        return $this->PartnerInterface->index($dataTable);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->PartnerInterface->show($id);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartnerRequest $request)
    {
        return $this->PartnerInterface->store($request);
    }

    public function create()
    {
        return $this->PartnerInterface->create();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->PartnerInterface->edit($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PartnerRequest $request, $id)
    {
        return $this->PartnerInterface->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->PartnerInterface->destroy($id);
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
        return $this->PartnerInterface->bulkDestroy($ids);
    }
}
