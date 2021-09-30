<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Language Lines
    |--------------------------------------------------------------------------
 */

'auth' => [
    'wrong_code' => 'The code entered is wrong',
    'user_not_found' => 'This user is not on the system',
],

'required' => [
    'code_required' => 'Activation code required',
    'mobile_required' => 'Mobile number required',
    'name_required' => 'Name required',
    'new_password_required' => 'New password is required',
    'device_type_required' => 'device_type not sent',
],

'country' => [
    'country_not_found' => 'The country is not in the system',
],

'client' => [
    'client_id_required' => 'client_id required',
    'client_not_found' => 'The client is not in the system',
    'user_has_been_banned' => 'User blocked: username',
    'ban_for_user_has_been_removed' => 'The ban has been lifted for the user: username',
],

'story' => [
    'story_not_found' => 'The post is not in the system',
    'comment_not_found' => 'Comment not found in the system',
],

'contact' => [
    'name_required' => 'Name required',
    'mobile_required' => 'Number is required',
    'email_required' => 'Email is required',
],

// notification
'notification' => [
    'notification_id_required' => 'notification_id required',
    'notification_not_found' => 'The notification is not in the system',

    'title' => [
        'new_friend_request' => 'new friend request',
        'accept_friend_request' => 'accept friend request',
        'new_comment_mention' => 'Someone tagged you in a comment',
        'comment' => 'Someone has commented on your post',
        'like' => 'Someone has reacted to your post',
        'retweeted_post' => 'Someone has returned a friend on your post',
        'follow' => 'someone followed you',
    ],
    'body' => [
        'new_friend_request' => ': sender_name has sent a new friend request',
        'accept_friend_request' => ': sender_name approved the friend request',
        'new_comment_mention' => 'Sender_name referenced you in a comment',
        'comment' => 'Has: sender_name commented on your post',
        'like' => ': sender_name interacted on your post',
        'retweeted_post' => ': sender_name has returned a vibrance to your post',
        'follow' => 'Followed by: sender_name',
    ],
],

'chat' => [
    'deleted_file' => 'The attached file was deleted',
    'file_attached' => 'A file has been attached',
    'coordinates_were_sent' => 'coordinates sent',
],

// FCM
'fcm' => [
    'title' => 'Apply',
    'new_chat_message' => 'new message',
    'messages' => [
    ],
],

'sms' => [
    'activation_code' => '% 20 activation code% 20 is% 20:% 20: activation_code',
],

'exceptions' => [
    'jwt' => [
        'token_expired_exception' => 'Token has expired',
        'token_invalid_exception' => 'Invalid Code',
        'jwt_exception' => 'You did not send code',
        'token_unauthorized' => 'unauthorized token',
    ],
    'not_found_exception' => 'An error occurred, please contact the administration',
],

'messages' => [
    'please_complete_the_data' => 'Please complete the details',
    'success_login' => 'Signed in successfully',
    'failed_login' => 'Wrong login information',
    'failed_data' => 'The entered data is invalid',
    'not_approved_message' => 'The administrator has not confirmed your information yet',
    'banned_message' => 'You have been banned by admin',
    'deactivation_message' => 'You have not activated your mobile phone yet',
    'success_register' => 'Registration was successful',
    'success_logout' => 'Successfully logged out',
    'added_successfully' => 'Added successfully',
    'updated_successfully' => 'Modified successfully',
    'deleted_successfully' => 'deleted successfully',
    'hidden_successfully' => 'hidden successfully',
    'has_already_been_deleted' => 'Removed by',
    'activated_successfully' => 'activated successfully',
    'sent_successfully' => 'Sent successfully',
    'has_already_been_submitted' => 'Sent by',
    'sent_code_successfully' => 'Code sent successfully',
    'not_allowed_to_modify' => 'You are not allowed to modify the data',
    'not_allowed_to_send' => 'You are not allowed to post',
    'not_allowed_to_delete' => 'You are not allowed to delete the data',
    'not_allowed_to_view' => 'You are not allowed to view the data',
    'something_went_wrong_please_try_again' => 'An error has occurred. Please try again ',
    'password_not_match' => 'Password does not match',
    'code_message' => 'Your verification code is',
    'you_are_already_active' => 'Already activated',
    'wrong_code_please_try_again' => 'The verification code is wrong. Please check the verification code ',
    'post_has_not_reached_the_required_threshold_for_posting_on_findly' => 'The post did not reach the required number of likes to post to findly',

    'monthly_subscription_is_not_currently_available' => 'Monthly subscription is not currently available',
    'you_cannot_change_the_subscription_when_the_previous_package_subscription_ends' => 'You can only change the subscription when the previous package subscription expires',
    'successful_subscription' => 'Subscribed successfully',
],
];