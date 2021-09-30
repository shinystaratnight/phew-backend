<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{ScreenShotPost};
use App\Http\Requests\Api\Post\{PostIdRequest, ScreenShotPostRequest};
use Illuminate\Http\Request;

class ScreenShotPostController extends Controller
{
    public function store(PostIdRequest $request, $post_id = null)
    {
        ScreenShotPost::updateOrCreate(['user_id' => auth('api')->id(), 'post_id' => $request->post_id], []);
        return response(['status' => 'true', 'message' => '', 'data' => null], 200);
    }

    public function store_multi(ScreenShotPostRequest $request)
    {
        auth('api')->user()->screen_shots()->syncWithoutDetaching($request->posts);
        return response(['status' => 'true', 'message' => '', 'data' => null], 200);
    }
}
