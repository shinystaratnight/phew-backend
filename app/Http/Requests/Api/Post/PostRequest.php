<?php

namespace App\Http\Requests\Api\Post;

use App\Http\Requests\Api\ApiMasterRequest;

class PostRequest extends ApiMasterRequest
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
            'post_id' => 'nullable|required_if:post_type,echo_with_comment|required_if:post_type,echo_without_comment|numeric|exists:posts,id',
            'post_type' => 'required|in:first,echo_with_comment,echo_without_comment',
            'activity_type' => 'required|in:normal,location,watching',
            'text' => 'nullable|required_if:post_type,echo_with_comment|required_without_all:images,videos,location,watching,post_id|string',
            'images' => 'nullable|array', // هحطها في الـ post mediable
            'images.*' => 'image|mimes:jpeg,jpg,png,gif',
            'videos' => 'nullable|array', // هحطها في الـ post mediable
            'videos.*' => 'file|mimes:mp4,opp,flv,3gp,mkv,avi,amv',
            'location' => 'nullable|json|required_if:activity_type,location', //['lat' => , 'lng' => , 'address' => ] // هحطها في الـ post mediable
            'watching' => 'nullable|json|required_if:activity_type,watching', // اللي هيتبعت هحفظه
            'movie_id' => 'nullable',
            'friends_with' => 'nullable|array', // الناس اللي عامل لهم mentions
            'friends_with.*' => 'numeric|exists:users,id',
            'show_privacy' => 'required|in:all,followers,friends,only_me',
        ];
    }

    public function getValidatorInstance()
    {
        $data = $this->all();
        if(isset($data['friends_with'])){
            $data['friends_with'] = json_decode($data['friends_with']);
        }
        if(isset($data['watching'])){
            $movie_data = json_decode($data['watching']);
            $data['movie_id'] = isset($movie_data->id) ? $movie_data->id : null;
        }
        $this->getInputSource()->replace($data);
        return parent::getValidatorInstance();
    }
}
