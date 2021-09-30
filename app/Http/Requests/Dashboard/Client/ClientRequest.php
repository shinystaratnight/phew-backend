<?php

namespace App\Http\Requests\Dashboard\Client;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        $client = $this->client;
        $password = 'required|min:6';
        $image = 'nullable|image|mimes:jpeg,jpg,png,gif';

        if ($client) {
            $password = 'nullable|min:6';
            $image = 'nullable|image|mimes:jpeg,jpg,png,gif';
        }
        return [
            'username' => 'required|unique:users,username,' . $client,
            'mobile' => 'required|numeric|min:10|unique:users,mobile,' . $client,
            'email' => 'required|email|unique:users,email,' . $client,
            'package_id'=> 'required|exists:packages,id',
            'country_id'=>'required|exists:countries,id',
            'city_id'=>'required|exists:cities,id',
            'password' => $password,
            'avatar' => $image,
            'gender' => 'nullable|in:male,female',
            'date_of_birth' => 'nullable|date|date_format:Y-m-d',
            'is_active' => 'required|in:1,0',
            'is_banned' => 'required|in:1,0',
            'ban_reason' => 'nullable|required_if:is_banned,1',
        ];
    }

    public function getValidatorInstance()
    {
        $data = $this->all();
        if (isset($data['date_of_birth']) && $data['date_of_birth'] != null) {
            $data['date_of_birth'] = date('Y-m-d', strtotime($data['date_of_birth']));
        }
        if (isset($data['city_id']) && $data['city_id'] != null) {
            $data['country_id'] = \App\Models\City::find($data['city_id'])->country_id;
        }
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
