<?php

namespace App\Http\Controllers\Api;

use App\Events\Chat\ChatEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Chat\{DeleteMessageRequest, ReceiverIdRequest, SendMessageRequest};
use App\Http\Resources\Chat\{ChatDetails, ConversationsList};
use App\Models\{Chat, Conversation};
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function index(Request $request)
    {
        try {
            $conversations = Conversation::where(function ($query) {
                $query->where(['sender_id' => auth('api')->id()]);
                $query->orWhere(['receiver_id' => auth('api')->id()]);
            })->latest()->get();
            return response()->json([
                'status' => 'true',
                'message' => '',
                'data' => $conversations != null ? ConversationsList::collection($conversations) : null,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => trans('app.messages.something_went_wrong_please_try_again'), 'data' => null], 401);
        }
    }

    public function show(ReceiverIdRequest $request)
    {
        if (auth('api')->id() == $request->id) {
            return response(['status' => 'false', 'message' => trans('app.messages.not_allowed_to_view'), 'data' => null], 401);
        }
        try {
            $conversation = Conversation::where(function ($query) {
                $query->where(['sender_id' => auth('api')->id()]);
                $query->orWhere(['receiver_id' => auth('api')->id()]);
            })->where(function ($query) use ($request) {
                $query->where(['sender_id' => $request->id]);
                $query->orWhere(['receiver_id' => $request->id]);
            })->first();
            return response()->json([
                'status' => 'true',
                'message' => '',
                'data' => $conversation != null ? ChatDetails::collection($conversation->chat_messages()->latest()->get()) : [],
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => trans('app.messages.something_went_wrong_please_try_again'), 'data' => null], 401);
        }
    }

    public function send(SendMessageRequest $request)
    {
        if (auth('api')->id() == $request->id) {
            return response(['status' => 'false', 'message' => trans('app.messages.not_allowed_to_send'), 'data' => null], 401);
        }
        \DB::beginTransaction();
        try {
            $conversation = Conversation::where(function ($query) use ($request) {
                $query->where(['sender_id' => auth('api')->id()]);
                $query->orWhere(['receiver_id' => auth('api')->id()]);
            })->where(function ($query) use ($request) {
                $query->where(['sender_id' => $request->id]);
                $query->orWhere(['receiver_id' => $request->id]);
            })->updateOrCreate([], [
                'sender_id' => auth('api')->id(),
                'receiver_id' => $request->id,
                'message_type' => $request->message_type,
                'last_message' => ($request->message_type == 'video' || $request->message_type == 'image' || $request->message_type == 'voice_message') ? '' : $request->message,
            ]);
            $chat = Chat::create([
                'sender_id' => auth('api')->id(),
                'conversation_id' => $conversation->id,
                'message_type' => $request->message_type,
                'message' => $request->message,
            ]);

            broadcast(new ChatEvent($conversation));

            // =========================== Notification ===========================
            // $title = trans('app.fcm.new_chat_message');

            // $fcm_data = [];
            // $fcm_data['title'] = $title;

            // if ($request->message_type == 'image') {
            //     $body_ar = 'قام ' . $request->user()->fullname . ' بإرسال صورة إليك.';
            //     $body_en = $request->user()->fullname . ' sent an image for you';
            // } else if ($request->message_type == 'voice_message') {
            //     $body_ar = 'قام ' . $request->user()->fullname . ' بإرسال ملف صوتي إليك.';
            //     $body_en = $request->user()->fullname . ' sent a voice message for you';
            // } else if ($request->message_type == 'location') {
            //     $body_ar = 'قام ' . $request->user()->fullname . ' بإرسال إحداثيات إليك.';
            //     $body_en = $request->user()->fullname . ' sent a location for you';
            // } else {
            //     $body_ar = 'قام ' . $request->user()->fullname . ' بإرسال رسالة إليك.';
            //     $body_en = $request->user()->fullname . ' sent a message for you';
            // }
            // $body = app()->getLocale() == 'ar' ? $body_ar : $body_en;

            // $data = [
            //     'key' => "new_chat_message",
            //     'title' => trans('app.fcm.new_chat_message'),
            //     'body' => $body,
            //     'order_id' => $order->id,
            //     'msg_type' => $request->message_type,
            //     'sender_id' => $request->user()->id,
            //     'sender_name' => $request->user()->fullname,
            //     'sender_logo' => $request->user()->profile_image,
            //     'message' => $chat->message_value,
            //     'time' => $chat->created_at->diffforhumans(),
            // ];
            // if ($conversation->receiver->devices) {
            //     pushFcmNotes($data, $conversation->receiver->devices);
            // }

            // =========================== Notification ===========================
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['status' => 'false', 'message' => trans('app.messages.something_went_wrong_please_try_again'), 'data' => null], 401);
        }
        return response()->json(['status' => 'true', 'message' => trans('app.messages.sent_successfully'), 'data' => new ChatDetails($chat)], 200);
    }

    public function delete_message(DeleteMessageRequest $request)
    {
        try {
            $chat = Chat::find($request->message_id);
            if (auth('api')->id() != $chat->sender_id) {
                return response(['status' => 'false', 'message' => trans('app.messages.not_allowed_to_delete'), 'data' => null], 401);
            }
            $chat->delete();
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
