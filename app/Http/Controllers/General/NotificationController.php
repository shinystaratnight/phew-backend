<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Device;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class NotificationController extends Controller
{
    public static function SEND_SINGLE_STATIC_NOTIFICATION($user_id, $notification_title, $notification_body, $notification_data, $time_to_live)
    {
        $user_devices = Device::where('user_id', $user_id)->get();
        foreach ($user_devices as $user_device) {
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive($time_to_live);
            $notificationBuilder = new PayloadNotificationBuilder($notification_title);
            $notificationBuilder->setBody($notification_body)->setSound('default');
            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData($notification_data);
            $option = $optionBuilder->build();
            if ($user_device->device_type == 'ios') {
                $notification = $notificationBuilder->build();
            } else {
                $notification = null;
            }
            $data = $dataBuilder->build();
            $downstreamResponse = FCM::sendTo($user_device->device_id, $option, $notification, $data);
        }
    }
}
