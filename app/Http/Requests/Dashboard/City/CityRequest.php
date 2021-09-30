<?php

namespace App\Http\Requests\Dashboard\City;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
        $rules = [
            'country_id' => 'required|exists:countries,id',
            'postal_code' => 'nullable',
            'short_cut' => 'nullable',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.name'] = 'required';
        }
        return $rules;
    }
}
