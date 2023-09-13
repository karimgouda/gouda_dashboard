<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SlidersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\SlidersInterface;
use App\Http\Requests\BulkDestroyRequest;
use App\Http\Requests\SlidersRequest;

class SlidersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $SlidersInterface;

    public function __construct(SlidersInterface $SlidersInterface){
        $this->SlidersInterface = $SlidersInterface ;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SlidersDataTable $dataTable)
    {
        return $this->SlidersInterface->index($dataTable);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->SlidersInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlidersRequest $request)
    {
        return $this->SlidersInterface->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->SlidersInterface->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->SlidersInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SlidersRequest $request, $id)
    {
        return $this->SlidersInterface->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->SlidersInterface->destroy($id);
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
        return $this->SlidersInterface->bulkDestroy($ids);
    }
}
