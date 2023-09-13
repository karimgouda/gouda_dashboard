<?php

namespace App\Http\Requests;

use App\Models\Policy;
use App\Models\BCategory;
use App\Services\SEO\SEOToolsService;
use App\Services\TranslatableService;
use Illuminate\Foundation\Http\FormRequest;

class PoliciesRequest extends FormRequest
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
            ['type'=>'required'],
            (new SEOToolsService)->getSEOToolsValidationRules(),
        );

        return TranslatableService::validateTranslatableFields(Policy::$translatableColumns) + $rules;
    }
}
