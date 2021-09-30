<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiMasterRequest;

class SocialLoginRequest extends ApiMasterRequest
{

    public $user_id = null;
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
            'provider_type' => 'required|in:facebook,twitter,google,apple',
            'provider_id' => 'required|unique:user_socials,provider_id,' . $this->user_id . ',user_id',
            // 'username' => 'required|string|unique:users,username,' . $this->user_id,
            'fullname' => 'required|string',
            'device_type' => 'nullable|in:ios,android',
            'device_token' => 'nullable',
        ];
    }

    public function getValidatorInstance()
    {
        $data = $this->all();
        if (isset($data['provider_type']) && $data['provider_type'] != null && isset($data['provider_id']) && $data['provider_id'] != null) {
            $user = \App\Models\User::whereHas('user_social', function ($query) use ($data) {
                $query->where(['provider_type' => $data['provider_type'], 'provider_id' => $data['provider_id']]);
            })->first();
            $this->user_id = $user ? $user->id : null;
        }
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
