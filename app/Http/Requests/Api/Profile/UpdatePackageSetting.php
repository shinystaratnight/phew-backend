<?php

namespace App\Http\Requests\Api\Profile;

use App\Http\Requests\Api\ApiMasterRequest;

class UpdatePackageSetting extends ApiMasterRequest
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
            'delete_inactive_followers_and_friends' => 'nullable',
        ];
    }
}
