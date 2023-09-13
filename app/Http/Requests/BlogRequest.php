<?php

namespace App\Http\Requests;

use App\Models\Blog;
use App\Services\ImageService;
use App\Services\SEO\SEOToolsService;
use App\Services\TranslatableService;
use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'tags'          => ['nullable'],
            'categories'    => ['nullable','array'],
            'is_publish'    => ['nullable', 'string','max:5'],
            'image'         => ['required', 'mimes:jpeg,png,jpg,gif,webp,svg'],
            ],
            (new ImageService)->getImageValidationRules(),
            (new SEOToolsService)->getSEOToolsValidationRules(),
        );

        if (in_array($this->method(), ['PUT', 'PATCH'])) $rules['image'] = ['nullable', 'mimes:jpeg,png,jpg,gif,webp,svg'];

        return TranslatableService::validateTranslatableFields(Blog::$translatableColumns) + $rules;
    }
}
