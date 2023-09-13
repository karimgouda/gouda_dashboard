<?php

namespace App\Http\Requests;

use App\Models\Testimonial;
use App\Services\SEO\SEOToolsService;
use App\Services\TranslatableService;
use Illuminate\Foundation\Http\FormRequest;

class testimonialsRequest extends FormRequest
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
        $rules = Testimonial::$rules;
        if (in_array($this->method(), ['PUT', 'PATCH'])) $rules['image'] = ['nullable', 'mimes:jpeg,png,jpg,gif,webp,svg'];
        return TranslatableService::validateTranslatableFields(Testimonial::$translatableColumns) + $rules;
    }
}
