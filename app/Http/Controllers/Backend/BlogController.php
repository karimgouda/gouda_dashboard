<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BlogDataTable;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\BCategoryInterface;
use App\Http\Interfaces\BlogInterface;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\BulkDestroyRequest;
use App\Models\BCategory;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $BlogInterface;

    public function __construct(BlogInterface $BlogInterface){
        $this->BlogInterface = $BlogInterface ;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BlogDataTable $dataTable)
    {
        return $this->BlogInterface->index($dataTable);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->BlogInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        return $this->BlogInterface->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->BlogInterface->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->BlogInterface->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
    {
        return $this->BlogInterface->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->BlogInterface->destroy($id);
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
        return $this->BlogInterface->bulkDestroy($ids);
    }
}
