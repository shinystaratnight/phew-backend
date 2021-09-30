<?php

namespace App\Http\Requests\Api\Comment;

use App\Http\Requests\Api\ApiMasterRequest;

class CommentRequest extends ApiMasterRequest
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
            'post_id' => 'required|numeric|exists:posts,id',
            'text' => 'nullable|required_without_all:images|string',
            'images' => 'nullable|array', // هحطها في الـ post mediable
            'images.*' => 'image|mimes:jpeg,jpg,png,gif',
        ];
    }

    public function getValidatorInstance()
    {
        $data = $this->all();
        if (!isset($data['post_id'])) {
            $data['post_id'] = $this->route('post_id');
        }
        $data['comment_type'] = 'post';
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
