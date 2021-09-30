<?php

namespace App\Http\Requests\Dashboard\Package;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
            'package_type' => 'required|in:free,paid',
            'period' => 'required|numeric',
            'period_type' => 'required|in:hours,days,weeks,months,years',
            'price' => 'required|numeric',
            'plan' => 'required|array',
            'plan.*' => 'required',
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.name'] = 'required';
        }
        return $rules;
    }

    public function getValidatorInstance()
    {
        $data = $this->all();
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
