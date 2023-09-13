<?php

namespace App\Http\Repositories;
use App\Http\Interfaces\TranslationInterface;
use App\Models\Service;
use App\Models\Translation;
use App\Services\BaseEloquentService;
use App\Services\TranslatableService;
use Illuminate\Support\Facades\Artisan;

class TranslationRepository extends BaseEloquentService implements TranslationInterface
{
    protected $modelName = Translation::class;

    public function __construct()
    {
        $this->instance = $this->getNewInstance();
    }


    public function index()
    {
        return view('backend.translations.index');
    }

    public function show($dataTable,$lang)
    {
        return $dataTable->with('lang',$lang)->render('backend.translations.show');
    }


    public function update($request, $id)
    {
        $this->instance = $this->findById($id);
        try {
            $this->executeSave(['lang_value' => $request->lang_value]);

               Artisan::call('cache:clear');
            return 'success';

          } catch (\Exception $e) {

              return $e->getMessage();
          }

    }

}
