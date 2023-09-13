<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Sitemap\SitemapGenerator;
use App\DataTables\ContactsDataTable;
use App\Http\Requests\BulkDestroyRequest;
use App\Http\Interfaces\SettingsInterface;
use App\Http\Requests\Settings\SettingRequest;
use App\Http\Requests\Settings\UpdateSettingsRequest;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $SettingsInterface;

    public function __construct(SettingsInterface $SettingsInterface){
        $this->SettingsInterface = $SettingsInterface ;
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->SettingsInterface->index();
    }

 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        return $this->SettingsInterface->store($request);
    }


  /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSettings(UpdateSettingsRequest $request)
    {
        return $this->SettingsInterface->updateSettings($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->SettingsInterface->destroy($id);
    }

    /**
     * Generate a sitemap file
     *
     * @return void
     */
    public function sitemap()
    {
        SitemapGenerator::create(env('APP_URL'))->writeToFile(public_path('sitemap.xml'));

        return redirect()->back()->with('success','Sitemap Generated Successfully');
    }

}
