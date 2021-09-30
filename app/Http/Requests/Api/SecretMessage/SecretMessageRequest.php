<?php

namespace App\Http\Requests\Api\SecretMessage;

use App\Http\Requests\Api\ApiMasterRequest;

class SecretMessageRequest extends ApiMasterRequest
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
            'sender_id' => 'required|integer|exists:users,id',
            'receiver_id' => 'required|integer|exists:users,id',
            'message' => 'required',
        ];
    }

    public function getValidatorInstance()
    {
        $data = $this->all();
        $data['receiver_id'] = $this->route('user_id');
        $data['sender_id'] = auth('api')->id();
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
