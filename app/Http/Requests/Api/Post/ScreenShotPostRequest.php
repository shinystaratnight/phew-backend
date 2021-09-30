<?php

namespace App\Http\Requests\Api\Post;

use App\Http\Requests\Api\ApiMasterRequest;

class ScreenShotPostRequest extends ApiMasterRequest
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
            'posts' => 'required|array',
            'posts.*' => 'integer|exists:posts,id',
        ];
    }

    public function getValidatorInstance()
    {
        $data = $this->all();
        if (isset($data['posts'])) {
            $data['posts'] = json_decode($data['posts'], TRUE);
        }
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
