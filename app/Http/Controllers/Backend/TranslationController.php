<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ServicesDataTable;
use App\DataTables\TranslationDataTable;
use App\Http\Controllers\Controller;
use App\Http\Interfaces\TranslationInterface;
use App\Http\Requests\BulkDestroyRequest;
use App\Http\Requests\ServiceRequest;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    private $TranslationInterface;

    public function __construct(TranslationInterface $TranslationInterface){
        $this->TranslationInterface = $TranslationInterface ;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->TranslationInterface->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TranslationDataTable $dataTable , $lang)
    {
        return $this->TranslationInterface->show($dataTable,$lang);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->TranslationInterface->update($request, $id);
    }


}
