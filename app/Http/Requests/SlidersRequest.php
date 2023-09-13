<?php

namespace App\Http\Requests;

use App\Services\ImageService;
use App\Services\SEO\SEOToolsService;
use Illuminate\Foundation\Http\FormRequest;

class SlidersRequest extends FormRequest
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
        $rules = array_merge(
            [
            'title_en' => ['nullable', 'string', 'max:100'],
            'title_ar' => ['nullable', 'string', 'max:100'],
            'link'     =>  ['nullable', 'url'],
            'image'    => ['required', 'mimes:jpeg,png,jpg,gif,webp,svg'],
            ],
            (new ImageService)->getImageValidationRules(),
            (new SEOToolsService)->getSEOToolsValidationRules(),
        );

        if (in_array($this->method(), ['PUT', 'PATCH'])) $rules['image'] = 'nullable';

        return $rules;
    }
}
