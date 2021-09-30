<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Notification\SendSingle;
use App\Http\Requests\Dashboard\Notification\SendMultiple;
use App\Http\Controllers\General\NotificationController as SendNotificationController;
use App\Models\Device;
use App\Models\User;
use App\Notifications\GeneralNotification;

class NotificationController extends Controller
{
    public function send_single_notification(SendSingle $request)
    {
        // $title_ar = 'قامت إدارة ' . settings('project_name_ar') . ' بإرسال إشعار';
        // $title_en = settings('project_name_en') . ' management has sent notice to you';
        // $title = app()->getLocale() == 'ar' ? $title_ar : $title_en;

        $fcm_data = [];
        $fcm_data['title'] = $request->title;
        $fcm_data['key'] = 'management_message';
        $fcm_data['body'] = $request->message;
        $fcm_data['msg_sender'] = settings('project_name_ar');
        $fcm_data['sender_logo'] = asset('storage/app/uploads/logo.png');
        $fcm_data['time'] = date('Y-m-d H:i:s');
        $user_id = $request->user_id;

        if (Device::where('user_id', $user_id)->exists()) {
            $devices = Device::where('user_id', $user_id)->get();
            pushFcmNotes($fcm_data, $devices);
        }

        $data_notification = [
            'key' => "management_message",
            'title' => [
                'ar' => $request->title,
                'en' => $request->title,
            ],
            'body' => [
                'ar' => $request->message,
                'en' => $request->message,
            ],
        ];
        $user = User::find($user_id);
        $user->notify(new GeneralNotification($data_notification));
        
        return back()->with('class', 'success')->with('message', trans('dash.messages.sent_successfully'));
    }

    public function send_multiple_notification(SendMultiple $request)
    {
        $users = User::where('type', $request->type)->get();
        foreach ($users as $user) {
            // $title_ar = 'قامت إدارة ' . settings('project_name_ar') . ' بإرسال إشعار';
            // $title_en = settings('project_name_en') . ' management has sent notice to you';
            // $title = app()->getLocale() == 'ar' ? $title_ar : $title_en;

            $fcm_data = [];
            $fcm_data['title'] = $request->title;
            $fcm_data['key'] = 'management_message';
            $fcm_data['body'] = $request->message;
            $fcm_data['msg_sender'] = auth()->user()->username;
            $fcm_data['sender_logo'] = asset('storage/app/uploads/logo.png');
            $fcm_data['time'] = date('Y-m-d H:i:s');
            // add_notification($user->id, 'management_message', 0, $request->message, $request->message, null);

            if (Device::where('user_id', $user->id)->exists()) {
                $devices = Device::where('user_id', $user->id)->get();
                pushFcmNotes($fcm_data, $devices);
            }

            $data_notification = [
                'key' => "management_message",
                'title' => [
                    'ar' => $request->title,
                    'en' => $request->title,
                ],
                'body' => [
                    'ar' => $request->message,
                    'en' => $request->message,
                ],
            ];
            $user->notify(new GeneralNotification($data_notification));
        }
        return back()->with('class', 'success')->with('message', trans('dash.messages.sent_successfully'));
    }
}
