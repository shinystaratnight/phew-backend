<?php

namespace App\Http\Requests\Api\Profile;

use App\Http\Requests\Api\ApiMasterRequest;

class UpdateProfile extends ApiMasterRequest
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
            'fullname' => 'nullable|string',
            'username' => 'nullable|string|between:2,191|unique:users,username,' . auth('api')->id(),
            'mobile' => 'nullable|numeric|min:10|unique:users,mobile,' . auth('api')->id(),
            'email' => 'nullable|email|unique:users,email,' . auth('api')->id(),
            'avatar' => 'nullable|array',
            'avatar.*' => 'image|mimes:jpeg,jpg,png,gif',
            'nationality_id' => 'nullable|numeric|exists:nationalities,id',
            'city_id' => 'nullable|numeric|exists:cities,id',
            // 'gender' => 'nullable|in:male,female',
            // 'date_of_birth' => 'nullable|date',
            // 'lat' => 'nullable',
            // 'lng' => 'nullable',
        ];
    }

    // public function getValidatorInstance()
    // {
    //     $data = $this->all();
    //     $this->getInputSource()->replace($data);
    //     return parent::getValidatorInstance();
    // }
}
