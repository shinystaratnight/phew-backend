<?php

namespace App\Http\Requests\Dashboard\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'permissions'=>'required|array',
            'permissions.*'=>'required|array',
            'permissions.*.*'=>'required|array',
            'countries'=>'nullable|array',
            'countries.*'=>'nullable|exists:countries,id',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules[$locale.".name"] = 'required';
            $rules[$locale.'.desc'] = 'nullable|string|between:3,100000';
        }
        return $rules;
    }
}
