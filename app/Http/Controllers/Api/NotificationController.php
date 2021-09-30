<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Notification\{NotificationList};
use App\Models\{Notification};

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        return response(['status' => 'true', 'message' => '', 'data' => NotificationList::collection(auth('api')->user()->notifications)], 200);
    }

    public function destroy(Request $request, $notification_id)
    {
        if ($notification_id == null)
            return response()->json(['status' => 'false', 'message' => trans('app.notification.notification_id_required'), 'data' => null], 422);
        if (!auth('api')->user()->notifications()->find($notification_id))
            return response()->json(['status' => 'false', 'message' => trans('app.messages.not_allowed_to_delete'), 'data' => null], 404);
        auth('api')->user()->notifications()->find($notification_id)->delete();
        return response(['status' => 'true', 'message' => trans('app.messages.deleted_successfully'), 'data' => null], 200);
    }
}