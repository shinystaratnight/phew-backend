<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\{PostResource};
use App\Http\Requests\Api\SecretMessage\{ReplySecretMessageRequest, SecretMessageRequest};
use App\Http\Resources\SecretMessage\{SecretMessageResource};
use App\Models\{SecretMessage};
use Illuminate\Http\Request;

class SecretMessageController extends Controller
{
    public function index(Request $request)
    {
        $messages = SecretMessage::where('receiver_id', auth('api')->id())->latest()->paginate(10);
        return response()->json(['status' => 'true', 'message' => '', 'data' => SecretMessageResource::collection($messages)]);
    }

    public function show(Request $request, $message_id)
    {
        $message = SecretMessage::where('receiver_id', auth('api')->id())->findOrFail($message_id);
        return response()->json(['status' => 'true', 'message' => '', 'data' => new SecretMessageResource($message)]);
    }

    public function send(SecretMessageRequest $request, $receiver_id)
    {
        \DB::beginTransaction();
        try {
            SecretMessage::create($request->validated());
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['status' => 'false', 'message' => trans('app.messages.something_went_wrong_please_try_again'), 'data' => null], 401);
        }
        return response()->json(['status' => 'true', 'message' => trans('app.messages.sent_successfully'), 'data' => null], 200);
    }

    public function reply(ReplySecretMessageRequest $request, $message_id)
    {
        \DB::beginTransaction();
        try {
            $post_data = array_only($request->validated(), ['post_type', 'activity_type', 'text', 'user_id']);
            $message = SecretMessage::where('receiver_id', auth('api')->id())->findOrFail($message_id);
            $post = $message->reply()->create($post_data + [
                    'city_id' => auth('api')->user()->city_id,
                    'country_id' => auth('api')->user()->country_id
                ]);
            if ($request->friends_with) {
                $post->mentions()->sync($request->friends_with);
            }
            $message->delete();
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['status' => 'false', 'message' => trans('app.messages.something_went_wrong_please_try_again'), 'data' => null], 401);
        }
        return response()->json(['status' => 'true', 'message' => '', 'data' => new PostResource($post)], 200);
    }

    public function destroy(Request $request, $message_id)
    {
        try {
            SecretMessage::where('receiver_id', auth('api')->id())->findOrFail($message_id)->delete();
            return response()->json([
                'status' => 'true',
                'message' => trans('app.messages.deleted_successfully'),
                'data' => null,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => trans('app.messages.something_went_wrong_please_try_again'), 'data' => null], 401);
        }
    }
}
