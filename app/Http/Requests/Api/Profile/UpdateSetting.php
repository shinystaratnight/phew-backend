<?php

namespace App\Http\Requests\Api\Profile;

use App\Http\Requests\Api\ApiMasterRequest;

class UpdateSetting extends ApiMasterRequest
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
            'all_notices' => 'nullable',
            'notification_to_new_followers' => 'nullable',
            'notification_to_mention' => 'nullable'
        ];
    }
}
