<?php

use LaravelFCM\Facades\FCM as FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\File as File;
use Illuminate\Support\Facades\Notification as Notification;
use App\Notifications\General\GeneralNotification;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

function filter_mobile_number($mob_num)
{
    $first_3_val = substr($mob_num, 0, 3);
    $sixth_val = substr($mob_num, 0, 6);
    $fifth_val = substr($mob_num, 0, 5);
    $first_val = substr($mob_num, 0, 1);
    $mob_number = 0;
    $val = 0;
    if ($sixth_val == "009665") {
        $val = null;
        $mob_number = substr($mob_num, 2);
    } elseif ($fifth_val == "00966") {
        $val = null;
        $mob_number = substr($mob_num, 2);
    } elseif ($first_3_val == "+96") {
        $val = "966";
        $mob_number = substr($mob_num, 4);
    } elseif ($first_3_val == "966") {
        $val = null;
        $mob_number = $mob_num;
    } elseif ($first_val == "5") {
        $val = "966";
        $mob_number = $mob_num;
    } elseif ($first_3_val == "009") {
        $val = "966";
        $mob_number = substr($mob_num, 4);
    } elseif ($first_val == "0") {
        $val = "966";
        $mob_number = substr($mob_num, 1);
    } else {
        $val = "966";
        $mob_number = $mob_num;
    }
    $real_mob_number = $val . $mob_number;
    return $real_mob_number;
}

/**
 * If User Out Of System
 *
 * @param  $outSystem
 * @param  $method
 * @param  $dataOfCommunicate
 */
function sendNotification($users, $dataArray, $via_methods = ['database', 'broadcast'], $outSystem = null, $method = null, $dataOfCommunticate = null)
{
    if ($outSystem) {
        Notification::route($method, $dataOfCommunticate)
            ->notify(new GeneralNotification($dataArray));
    } else {
        Notification::send($users, new GeneralNotification($dataArray, $via_methods));
    }
}

/**
 * Upload Image(s)
 *
 * @param  $image(s)
 * @param  $url
 * @param  $keyInArrayIfMultiple
 * @param  $width
 * @param  $height
 */
function uploadImg($files, $url = 'images', $key = 'image', $width = null, $height = null)
{
    $dist = storage_path('app/public/' . $url . "/");
    if ($url != 'images' && !File::isDirectory(storage_path('app/public/uploads/' . $url . "/"))) {
        File::makeDirectory(storage_path('app/public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $url . DIRECTORY_SEPARATOR), 0777, true);
        $dist = storage_path('app/public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $url . DIRECTORY_SEPARATOR);
    } elseif (File::isDirectory(storage_path('app/public/uploads/' . $url . "/"))) {
        $dist = storage_path('app/public/uploads/' . $url . "/");
    }
    $image = "";
    if (!is_array($files)) {
        $dim = getimagesize($files);
        $width = $width ?? $dim[0];
        $height = $height ?? $dim[1];
    }

    if (gettype($files) == 'array') {
        $image = [];
        foreach ($files as $img) {
            $dim = getimagesize($img);
            $width = $width ?? $dim[0];
            $height = $height ?? $dim[1];
            if ($img) {
                Image::make($img)->resize($width, $height, function ($cons) {
                    $cons->aspectRatio();
                })->save($dist . $img->hashName());
                $image[][$key] = $img->hashName();
            }
        }
    } else {
        Image::make($files)->resize($width, $height, function ($cons) {
            $cons->aspectRatio();
        })->save($dist . $files->hashName());
        $image = $files->hashName();
    }
    return $image;
}

function generate_code($length = 4)
{
    return '1111';
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $token = '';
    for ($i = 0; $i < $length; $i++) {
        $token .= $characters[rand(0, $charactersLength - 1)];
    }
    return $token;
}

function generate_random_file_name($length = 12)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $generate_random_image_key = '';
    for ($i = 0; $i < $length; $i++) {
        $generate_random_image_key .= $characters[rand(0, $charactersLength - 1)];
    }
    return $generate_random_image_key;
}

function generate_unique_card_code($length, $model, $type)
{
    if ($type == 'numbers')
        $characters = '0123456789';
    else
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $generate_random_code = '';
    for ($i = 0; $i < $length; $i++) {
        $generate_random_code .= $characters[rand(0, $charactersLength - 1)];
    }
    if ($model::where('code', $generate_random_code)->exists()) {
        generate_random_shipping_card();
    }
    return $generate_random_code;
}

function settings($param)
{
    return optional(App\Models\Setting::where('key', $param)->first())->value;
}

function distance($startLat, $startLng, $endLat, $endLng, $unit = "K")
{
    // $unit = M --> Miles
    // $unit = K --> Kilometers
    // $unit = N --> Nautical Miles

    $startLat = (float) $startLat;
    $startLng = (float) $startLng;
    $endLat = (float) $endLat;
    $endLng = (float) $endLng;
    $google_map_key = settings('google_map_key');

    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=" . $startLat . "," . $startLng . "&destinations=" . $endLat . "," . $endLng . "&language=ar" . "&sensor=false&mode=driving&key=" . $google_map_key;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response, true);
    try {
        return isset($response_a['rows'][0]['elements'][0]['distance']) ? $response_a['rows'][0]['elements'][0]['distance']['value'] : 0;
    } catch (Exception $e) {
        return 000;
    }
}

function is_friend($from_id, $to_id)
{
    $friend = \App\Models\FriendUser::where(function ($query) use ($from_id) {
        $query->where(['user_id' => $from_id]);
        $query->orWhere(['friend_id' => $from_id]);
    })->where(function ($query) use ($to_id) {
        $query->where(['user_id' => $to_id]);
        $query->orWhere(['friend_id' => $to_id]);
    })->first();
    if ($friend) {
        return true;
    }
    return false;
}

function is_follow($from_id, $to_id)
{
    $follow = \App\Models\FollowUser::where(['from_user_id' => $from_id, 'to_user_id' => $to_id])->first();
    if ($follow) {
        return true;
    }
    return false;
}

function is_like($user_id, $post_id)
{
    $like = \App\Models\LikePost::where(['user_id' => $user_id, 'post_id' => $post_id])->first();
    if ($like) {
        return true;
    }
    return false;
}

function is_fav($user_id, $post_id)
{
    $like = \App\Models\FavPost::where(['user_id' => $user_id, 'post_id' => $post_id])->first();
    if ($like) {
        return true;
    }
    return false;
}

function subscribe_data($user){
    $subscribe = $user->package_user()->latest()->first();
    if($subscribe && ($subscribe->subscription_start_date <= now()->format('Y-m-d') && $subscribe->subscription_end_date >= now()->format('Y-m-d'))){
        return true;
    }
    return false;
}

function online_users()
{
    $client = new Client();
    $online_users = $client->request('GET', settings('url_echo') . '/apps/' . settings('echo_app_id') . '/channels/presence-online/users', [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . settings('echo_auth_key')
        ],
    ]);
    return collect(json_decode($online_users->getBody()->getContents(), true)['users']);
}

function get_extend_date_from_now($period_type, $period_count)
{
    $now = \Carbon\Carbon::now()->setTimezone('Asia/Riyadh');
    if ($period_type == 'minutes') {
        $new_date = $now->addMinutes($period_count);
    } elseif ($period_type == 'hours') {
        $new_date = $now->addHours($period_count);
    } elseif ($period_type == 'days') {
        $new_date = $now->addDays($period_count);
    } elseif ($period_type == 'weeks') {
        $new_date = $now->addWeeks($period_count);
    } elseif ($period_type == 'months') {
        $new_date = $now->addMonths($period_count);
    } elseif ($period_type == 'years') {
        $new_date = $now->addYears($period_count);
    }
    return $new_date;
}

function get_extend_date_from_specific_date($date, $period_type, $period_count)
{
    $new_date = $date;
    if ($period_type == 'minutes') {
        $new_date = $new_date->addMinutes($period_count);
    } elseif ($period_type == 'hours') {
        $new_date = $new_date->addHours($period_count);
    } elseif ($period_type == 'days') {
        $new_date = $new_date->addDays($period_count);
    } elseif ($period_type == 'weeks') {
        $new_date = $new_date->addWeeks($period_count);
    } elseif ($period_type == 'months') {
        $new_date = $new_date->addMonths($period_count);
    } elseif ($period_type == 'years') {
        $new_date = $new_date->addYears($period_count);
    }
    return $new_date;
}

function add_notification($user_id, $key, $key_id, $msg_ar, $msg_en, $from_user_id)
{
    $new_notification = new App\Models\Notification();
    $new_notification->user_id = $user_id;
    $new_notification->from_user_id = $from_user_id;
    $new_notification->key = $key;
    $new_notification->key_id = $key_id;
    $new_notification->msg_ar = $msg_ar;
    $new_notification->msg_en = $msg_en;
    $new_notification->is_seen = 'unseen';
    $new_notification->save();
    return true;
}

function random_colors()
{
    $color_array = [
        'slate-300', 'grey-300', 'brown-300', 'green-600', 'brown-600',
        'orange-300', 'orange-700', 'slate-700', 'green-300', 'teal-300',
        'blue-300', 'green-800', 'blue-600', 'blue-800', 'indigo-300', 'indigo-700',
        'purple-300', 'purple-600', 'violet-300', 'violet-600', 'pink-300', 'pink-600',
        'info-300', 'info-600', 'info-800', 'danger-300', 'danger-600'
    ];
    return $color_array[array_rand($color_array)];
}

function pushFcmNotes($fcmData, $devices)
{
    foreach ($devices as $device) {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);
        $notificationBuilder = new PayloadNotificationBuilder($fcmData['title']);
        $notificationBuilder->setBody($fcmData['body'])->setSound('default');
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($fcmData);
        $option = $optionBuilder->build();
        if ($device->device_type == 'ios') {
            $notification = $notificationBuilder->build();
        } else {
            $notification = null;
        }
        $data = $dataBuilder->build();
        $downstreamResponse = FCM::sendTo($device->device_token, $option, $notification, $data);
        // dd($downstreamResponse);
    }
}
