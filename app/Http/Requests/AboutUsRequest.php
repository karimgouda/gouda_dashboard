<?php

namespace App\Http\Requests;

use App\Services\ImageService;
use App\Services\SEO\SEOToolsService;
use Illuminate\Foundation\Http\FormRequest;

class AboutUsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return array_merge(
            [
            'company_name_en' => ['required','string','max:100'],
            'company_name_ar' => ['required','string','max:100'],
            'description_en' => ['required','string'],
            'description_ar' => ['required','string'],
            'creation_date'  => ['required','string','max:100'],
            'image' =>          ['mimes:jpeg,png,jpg,gif,webp,svg'],
            ],
            (new ImageService)->getImageValidationRules(),
            (new SEOToolsService)->getSEOToolsValidationRules(),
        );
    }
}
