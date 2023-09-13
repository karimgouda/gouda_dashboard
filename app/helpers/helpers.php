<?php

use App\Models\Setting;
use App\Models\Translation;
use Illuminate\Support\Facades\Cache;

function is_active(array $routeNames){
    return in_array(explode('.',Route::currentRouteName())[0],$routeNames) ? 'active' : '';

}// end is_active


function is_true(array $routeNames){
    return in_array(explode('.',Route::currentRouteName())[0],$routeNames) ? 'true' : 'false';
}// end is_true


function is_show(array $routeNames){
    return in_array(explode('.',Route::currentRouteName())[0],$routeNames) ? 'show' : '';
}// end is_show



function settings(string $key){

    $settings = Cache::rememberForever('settings', function (){
        return Setting::select('key','value')->pluck('value', 'key')->toArray();
    });
    return  $settings[$key] ?? '';
}// end settings


function translate($key, $lang = null, $addslashes = false)
{
    if ($lang == null) {
        $lang = App::getLocale();
    }
    $lang_key = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($key)));
    $translations_en = Cache::rememberForever('translations-en', function () {
        return Translation::where('lang', 'en')->pluck('lang_value', 'lang_key')->toArray();
    });

    if (!isset($translations_en[$lang_key])) {
        $translation_def = new Translation;
        $translation_def->lang = 'en';
        $translation_def->lang_key = $lang_key;
        $translation_def->lang_value = str_replace(array("\r", "\n", "\r\n","_"), " ", $key);
        $translation_def->save();
        Cache::forget('translations-en');
    }


    $translations_ar = Cache::rememberForever('translations-ar', function () {
        return Translation::where('lang', 'ar')->pluck('lang_value', 'lang_key')->toArray();
    });

    if (!isset($translations_ar[$lang_key])) {
        $translation_def = new Translation;
        $translation_def->lang = 'ar';
        $translation_def->lang_key = $lang_key;
        $translation_def->lang_value = str_replace(array("\r", "\n", "\r\n","_"), " ", $key);
        $translation_def->save();
        Cache::forget('translations-ar');
    }

    // return user session lang
    $translation_locale = Cache::rememberForever("translations-{$lang}", function () use ($lang) {
        return Translation::where('lang', $lang)->pluck('lang_value', 'lang_key')->toArray();
    });


    if (isset($translation_locale[$lang_key])) {
        return $addslashes ? addslashes(trim($translation_locale[$lang_key])) : trim($translation_locale[$lang_key]);
    }

    // // return default lang if session lang not found
    $translations_default = Cache::rememberForever('translations-' . env('DEFAULT_LANGUAGE', 'en'), function () {
        return Translation::where('lang', env('DEFAULT_LANGUAGE', 'en'))->pluck('lang_value', 'lang_key')->toArray();
    });

    if (isset($translations_default[$lang_key])) {
        return $addslashes ? addslashes(trim($translations_default[$lang_key])) : trim($translations_default[$lang_key]);
    }

    // fallback to en lang
    if (!isset($translations_en[$lang_key])) {
        return trim($key);
    }

    return $addslashes ? addslashes(trim($translations_ar[$lang_key])) : trim($translations_en[$lang_key]);
}

if(!function_exists('image_name')) {

    /**
     * Get the image name from its full path
     *
     * @param string $imagePath
     * @return string
     */
    function image_name (string $imagePath)
    {
        return isset(pathinfo($imagePath)['filename']) ? pathinfo($imagePath)['filename'] : '';
    }
}
