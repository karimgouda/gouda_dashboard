<?php

namespace App\Http\Requests;

use App\Models\BCategory;
use App\Services\TranslatableService;
use Illuminate\Foundation\Http\FormRequest;

class BCategoryRequest extends FormRequest
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
        return TranslatableService::validateTranslatableFields(BCategory::$translatableColumns) ;
    }
}
