<?php

namespace App\Http\Requests\Api\Chat;

use App\Http\Requests\Api\ApiMasterRequest;

class SendMessageRequest extends ApiMasterRequest
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
            'message_type' => 'required|in:text,image,video,location,voice_message',
            'message' => 'required',
        ];
    }

    public function getValidatorInstance()
    {
        $data = $this->all();
        if (!isset($data['id'])) {
            $data['id'] = $this->route('user_id');
        }
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
