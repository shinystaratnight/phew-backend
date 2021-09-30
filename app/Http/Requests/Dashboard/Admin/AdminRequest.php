<?php

namespace App\Http\Requests\Dashboard\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        $admin = $this->admin;
        $password = 'required|min:6';
        $image = 'nullable|image|mimes:jpeg,jpg,png,gif';

        if ($admin) {
            $password = 'nullable|min:6';
            $image = 'nullable|image|mimes:jpeg,jpg,png,gif';
        }
        return [
            'role_id' => 'required|numeric|exists:roles,id',
            'fullname' => 'required|string|between:2,191',
            'mobile' => 'required|numeric|min:10|unique:users,mobile,' . $admin,
            'email' => 'required|email|unique:users,email,' . $admin,
            'password' => $password,
            'avatar' => $image,
            'is_active' => 'required|in:1,0',
            'is_banned' => 'required|in:1,0',
            'ban_reason' => 'nullable|required_if:is_banned,1',
        ];
    }
}
