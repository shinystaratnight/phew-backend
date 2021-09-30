<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Comment\{CommentRequest};
use App\Http\Resources\Post\{CommentResource};
use App\Http\Resources\User\{UserListResource};
use App\Models\{Post};
use Illuminate\Http\Request;
use App\Notifications\Api\ApiNotification;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $comments = Post::findOrFail($id)->comments()->latest()->get();
        return response()->json(['status' => 'true', 'message' => '', 'data' => CommentResource::collection($comments)], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        \DB::beginTransaction();
        try {
            $post = Post::find($request->post_id);
            $comment_data = array_except($request->validated(), ['post_id', 'images']);
            $comment = $post->comments()->create($comment_data + ['user_id' => auth('api')->id()]);
            if(auth('api')->id() != $post->user_id){
                $data = [
                    'key' => "comment",
                    'key_type' => "post",
                    'key_id' => $post->id,
                    'title' => [
                            'ar' => trans('app.notification.title.comment', [], 'ar'),
                            'en' => trans('app.notification.title.comment', [], 'en'),
                        ],
                    'body' => [
                        'ar' => trans('app.notification.body.comment', ['sender_name' => auth('api')->user()->fullname], 'ar'),
                        'en' => trans('app.notification.body.comment', ['sender_name' => auth('api')->user()->fullname], 'en'),
                    ],
                    'sender_data' => new UserListResource(auth('api')->user()),
                ];
                $post->user->notify(new ApiNotification($data, ['database', 'fcm']));
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            dd($e);
            return response()->json(['status' => 'false', 'message' => trans('app.messages.something_went_wrong_please_try_again'), 'data' => null], 401);
        }
        return response()->json(['status' => 'true', 'message' => '', 'data' => new CommentResource($comment)], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
