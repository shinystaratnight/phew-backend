<?php

namespace App\Http\Requests\Dashboard\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileData extends FormRequest
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
        return [
            'fullname' => 'required',
            'email' => 'nullable|email|unique:users,email,' . auth()->id(),
            'mobile' => 'required|numeric|min:10|unique:users,mobile,' . auth()->id(),
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ];
    }

    // public function getValidatorInstance()
    // {
    //     $data = $this->all();
    //     if (isset($data['mobile']) && $data['mobile'] != null) {
    //         $data['mobile'] = filter_mobile_number($data['mobile']);
    //     }
    //     $this->getInputSource()->replace($data);
    //     return parent::getValidatorInstance();
    // }
}
