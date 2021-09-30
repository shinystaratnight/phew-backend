<?php

namespace App\Http\Requests\Dashboard\Chat;

use Illuminate\Foundation\Http\FormRequest;

class ChatRequest extends FormRequest
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
        if ($this->message_type == 'image') {
            $message = 'required|image|mimes:png,jpg,jpeg';
        }elseif($this->message_type == 'store'){
            $message = 'required|exists:stores,id';
        }else{
            $message = 'required|string|between:1,200';
        }

        return [
            'message_type' => 'required|in:text,image,store',
            'message' => $message,
            'user_id' => 'required|exists:users,id',
        ];
    }
}
