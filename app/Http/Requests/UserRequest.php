<?php

namespace App\Http\Requests;

use App\Services\ImageService;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = array_merge([
            'name'     => ['required', 'string'],
            'email'    =>  ['required', 'email','unique:users,email'],
            'password' => ['required','min:6','confirmed'],
            'image'    => ['nullable', 'mimes:jpeg,png,jpg,gif,webp,svg'],
        ], (new ImageService)->getImageValidationRules() );

        if (in_array($this->method(), ['PUT', 'PATCH']))
        {
            $rules['image']    = 'nullable';
            $rules['email']    = ['required', 'email','unique:users,email,'.$this->route('user')];
            $rules['password'] = 'nullable';
        }

        return $rules;
    }
}
