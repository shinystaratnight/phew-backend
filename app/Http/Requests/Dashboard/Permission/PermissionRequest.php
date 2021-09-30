<?php

namespace App\Http\Requests\Dashboard\Permission;

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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'plan' => 'required|array|min:1',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.name'] = 'required';
        }
        return $rules;
    }

    public function getValidatorInstance()
    {
        $data = $this->all();
        if (isset($data['roles']) && $data['roles'] != null) {
            $data['plan'] = $data['roles'];
        }
        unset($data['roles']);
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
