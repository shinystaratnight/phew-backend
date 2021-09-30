<?php

namespace App\Http\Requests\Dashboard\Manager;

use Illuminate\Foundation\Http\FormRequest;

class ManagerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $manager = $this->manager ? $this->manager->id : null;
        $password = 'required|min:6';

        if ($manager) {
            $password = 'nullable|min:6';
        }
        return [
            'username' => 'required|unique:users,username,' . $manager,
            'first_name' => 'required|string|between:2,191',
            'last_name' => 'required|string|between:2,191',
            'mobile' => 'required|numeric|min:10|unique:users,mobile,' . $manager,
            'email' => 'required|email|unique:users,email,' . $manager,
            'password' => $password,
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date|date_format:Y-m-d',
            'is_active' => 'required|in:1,0',
            'is_banned' => 'required|in:1,0',
            'ban_reason' => 'nullable|required_if:is_banned,1',
            'nationality_id' => 'required|numeric|exists:nationalities,id',
            'role_id' => 'required|exists:roles,id',
        ];
    }

    public function getValidatorInstance()
    {
        $data = $this->all();
        if (isset($data['date_of_birth']) && $data['date_of_birth'] != null) {
            $data['date_of_birth'] = date('Y-m-d', strtotime($data['date_of_birth']));
        }
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
