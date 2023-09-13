<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
        $rules =  [
            'name' => ['required', 'string', 'max:100','unique:permissions,name'],
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) $rules['name'] = ['required', 'string', 'max:100','unique:permissions,name,'. $this->route('permission')];

        return $rules;
    }
}
