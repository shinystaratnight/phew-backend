<?php

namespace App\Http\Requests\Api\Chat;

use App\Http\Requests\Api\ApiMasterRequest;

class DeleteMessageRequest extends ApiMasterRequest
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
            'id' => 'required|numeric|exists:users',
            'message_id' => 'required|numeric|exists:chats,id',
        ];
    }

    public function getValidatorInstance()
    {
        $data = $this->all();
        if (!isset($data['id'])) {
            $data['id'] = $this->route('user_id');
        }
        if (!isset($data['message_id'])) {
            $data['message_id'] = $this->route('message_id');
        }
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
