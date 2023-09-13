<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ContactsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\ContactsInterface;
use App\Http\Requests\BulkDestroyRequest;
use App\Http\Requests\ContactsRequest;
use App\Http\Requests\ContactsStatusRequest;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $ContactsInterface;

    public function __construct(ContactsInterface $ContactsInterface){
        $this->ContactsInterface = $ContactsInterface ;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContactsDataTable $dataTable)
    {
        return $this->ContactsInterface->index($dataTable);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->ContactsInterface->show($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactsRequest $request)
    {
        return $this->ContactsInterface->store($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id,$status)
    {
        return $this->ContactsInterface->updateStatus($id,$status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->ContactsInterface->destroy($id);
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
        return $this->ContactsInterface->bulkDestroy($ids);
    }
}
