<?php

namespace App\Http\Requests\Settings;

use App\Services\SEO\SEOToolsService;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
                'type'  => ['required','string'],
                'key'   => ['required','string'],
                'value' => ['required','string'],
                'name'  => ['required','string'],
                'rules' => ['required','string'],
                (new SEOToolsService)->getSEOToolsValidationRules(),
            ],

        );
    }
}
