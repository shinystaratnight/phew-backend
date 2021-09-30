<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;


class RegisterRequest extends ApiMasterRequest
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
            'fullname' => 'required|string',
            'mobile' => 'required|numeric|min:10|unique:users,mobile',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'avatar' => 'nullable|array',
            'avatar.*' => 'image|mimes:jpeg,jpg,png,gif',
            'cover' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'country_id' => 'nullable|numeric|exists:countries,id',
            'city_id' => 'nullable|numeric|exists:cities,id',
            // 'gender' => 'nullable|in:male,female',
            // 'date_of_birth' => 'nullable|date',
            // 'lat' => 'required',
            // 'lng' => 'required',
            'device_type' => 'nullable|in:ios,android',
            'device_token' => 'nullable',
        ];
    }

    // public function getValidatorInstance()
    // {
    //     $data = $this->all();
    //     $this->getInputSource()->replace($data);
    //     return parent::getValidatorInstance();
    // }
}
