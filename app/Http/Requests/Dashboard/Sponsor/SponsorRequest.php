<?php

namespace App\Http\Requests\Dashboard\Sponsor;

use Illuminate\Foundation\Http\FormRequest;

class SponsorRequest extends FormRequest
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
        $sponsor = $this->sponsor;
        $image = 'required|image|mimes:jpeg,jpg,png,gif';

        if ($sponsor) {
            $image = 'nullable|image|mimes:jpeg,jpg,png,gif';
        }
        $rules = [
            'logo' => $image,
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.name'] = 'required';
        }
        return $rules;
    }
}
