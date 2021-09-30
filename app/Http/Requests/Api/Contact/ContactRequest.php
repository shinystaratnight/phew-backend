<?php

namespace App\Http\Requests\Api\Contact;

use App\Http\Requests\Api\ApiMasterRequest;

class ContactRequest extends ApiMasterRequest
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
            'user_id' => 'nullable|numeric|exists:users,id',
            'fullname' => 'required|string',
            'mobile' => 'required|string',
            'email' => 'required|string',
            'title' => 'required|string',
            'content' => 'required|string',
            'attachment' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ];
    }

    public function getValidatorInstance()
    {
        $data = $this->all();
        if (auth('api')->check()) {
            $data['user_id'] = auth('api')->id();
            $data['fullname'] = auth('api')->user()->username;
            $data['mobile'] = auth('api')->user()->mobile;
            $data['email'] = auth('api')->user()->email;
        }
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
