<?php

namespace App\Http\Repositories;

use App\Models\Setting;
use Illuminate\Support\Facades\File;
use App\Services\BaseEloquentService;
use App\Services\TranslatableService;
use Illuminate\Support\Facades\Artisan;
use App\Http\Interfaces\SettingsInterface;
use App\Models\SEOTool;
use App\Services\SEO\SEOToolsService;

class SettingsRepository extends BaseEloquentService implements SettingsInterface
{

    protected $modelName = Setting::class;

    public function __construct()
    {
        $this->instance = $this->getNewInstance();
    }


    public function index()
    {
        $this->setOrderBy('order');
        $this->setOrderDirection('asc');
        $settings = $this->getAll();

        $seoInputs = $settings->whereIn('key', ['head_manager_script', 'body_manager_script']);

        // A row to hold and desplay the SEO Tool results
        $row = SEOTool::where('is_for_setting', true)->exists() ? SEOTool::where('is_for_setting', true)->first()->toArray() : [];

        return view('backend.settings.index',compact('settings', 'row'));
    }



    /**
     * Store function to add a new custom field to the settings table
     *
     * @param Request $request
     */
    public function store($request)
    {
        $this->executeSave($request->validated());
        Artisan::call('cache:clear');
        return redirect()->route('settings.index')->with(['success'=>'settings created successfully','custom'=>'active']);
    }


    public function updateSettings($request)
    {
        $data   = TranslatableService::getNonTranslatableFields($this->instance, $request->all());
        $data   = (SEOToolsService::withRequest($request))->handleSettingSEOTools($data);

        if(isset($data['robots_file'])) {
            $robotsFile = $data['robots_file'];
            $robotsFile->move(public_path(), $robotsFile->getClientOriginalName());
            unset($data['robots_file']);
        }

        foreach($data as $key => $value){
            if($value && $key != '_token'){
                $this->instance = $this->findBy('key',$key);
                $this->executeSave(['value'=>$value]);
            }
        }

        Artisan::call('cache:clear');


        return redirect()->route('settings.index')->with(['success'=>'settings updated successfully']);
    }


    public function destroy($id)
    {
        $this->delete($id);
        Artisan::call('cache:clear');

        return redirect()->route('settings.index')->with(['success'=>'settings deleted successfully','custom'=>'active']);
    }


}
