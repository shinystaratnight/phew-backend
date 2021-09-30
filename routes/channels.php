<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('phew-notification.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('phew-chat.{chat_id}', function ($user, $chat_id) {
    return \App\Models\Chat::find($chat_id) ? true : false;
});

Broadcast::channel('online', function ($user) {
    return $user;
});
