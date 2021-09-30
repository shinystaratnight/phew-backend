<?php

namespace App\Http\Requests\Api\Post;

use App\Http\Requests\Api\ApiMasterRequest;

class PostIdRequest extends ApiMasterRequest
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
            'post_id' => 'required|integer|exists:posts,id',
        ];
    }

    public function getValidatorInstance()
    {
        $data = $this->all();
        if (!isset($data['post_id'])) {
            $data['post_id'] = $this->route('post_id');
        }
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
