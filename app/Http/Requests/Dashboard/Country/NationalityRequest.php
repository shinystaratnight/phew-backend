<?php

namespace App\Http\Requests\Dashboard\Country;

use Illuminate\Foundation\Http\FormRequest;

class NationalityRequest extends FormRequest
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
        $nationality = $this->nationality ? $this->nationality : null;
        $rules = [
            // 'ordering' => 'nullable|integer|gt:0'
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.name'] = 'required|unique:nationality_translations,name,' . $nationality . ',nationality_id';
        }
        return $rules;
    }
}
