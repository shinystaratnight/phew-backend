<?php

namespace App\Http\Requests\Dashboard\Country;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
        $country = $this->country ? $this->country : null;
        $image = 'nullable|image|mimes:jpeg,jpg,png,gif';
        if ($this->country) {
            $image = 'nullable|image|mimes:jpeg,jpg,png,gif';
        }
        $rules = [
            'in_findly' => 'required|in:1,0',
            'short_name' => 'required',
            'show_phonecode' => 'required',
            'phonecode' => 'required',
            'flag' => $image,
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.name'] = 'required|unique:country_translations,name,' . $country . ',country_id';
            $rules[$locale . '.currency'] = 'required';
        }
        return $rules;
    }
}
