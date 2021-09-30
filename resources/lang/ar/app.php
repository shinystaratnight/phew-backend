<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Language Lines
    |--------------------------------------------------------------------------
 */

    'auth' => [
        'wrong_code' => 'الكود المدخل خاطئ',
        'user_not_found' => 'هذا المستخدم غير موجود بالنظام',
    ],

    'required' => [
        'code_required' => 'كود التفعيل مطلوب',
        'mobile_required' => 'رقم الجوال مطلوب',
        'name_required' => 'الاسم مطلوب',
        'new_password_required' => 'كلمة المرور الجديدة مطلوبة',
        'device_type_required' => 'device_type لم تقم بإرسال',
    ],

    'country' => [
        'country_not_found' => 'الدولة غير موجودة بالنظام',
    ],

    'client' => [
        'client_id_required' => 'client_id مطلوب',
        'client_not_found' => 'العميل غير موجود بالنظام',
        'user_has_been_banned' => 'تم حظر المستخدم :username',
        'ban_for_user_has_been_removed' => 'تم رفع الحظر عن المستخدم :username',
    ],

    'story' => [
        'story_not_found' => 'المنشور غير موجود بالنظام',
        'comment_not_found' => 'التعليق غير موجود بالنظام',
    ],

    'contact' => [
        'name_required' => 'الإسم مطلوب',
        'mobile_required' => 'الرقم مطلوب مطلوب',
        'email_required' => 'البريد الإلكتروني مطلوب مطلوب',
    ],

    // notification
    'notification' => [
        'notification_id_required' => 'notification_id مطلوب',
        'notification_not_found' => 'الإشعار غير موجود بالنظام',

        'title' => [
            'new_friend_request' => 'طلب صداقة جديد',
            'accept_friend_request' => 'الموافقة على طلب صداقة',
            'new_comment_mention' => 'قام أحد ما بالإشارة إليك في تعليق',
            'comment' => 'قام أحد ما تعليق على منشور لك',
            'like' => 'قام أحد ما بالتفاعل على منشور لك',
            'retweeted_post' => 'قام أحد ما بإعادة صدي على منشور لك',
            'follow' => 'قام أحد ما بمتابعتك',
        ],
        'body' => [
            'new_friend_request' => 'قام :sender_name بإرسال طلب صداقة جديد',
            'accept_friend_request' => 'قام :sender_name بالموافقة على طلب الصداقة',
            'new_comment_mention' => 'قام :sender_name بالإشارة إليك في تعليق',
            'comment' => 'قام :sender_name بالتعليق على منشور لك',
            'like' => 'قام :sender_name بالتفاعل على منشور لك',
            'retweeted_post' => 'قام :sender_name بإعادة صدي على منشور لك',
            'follow' => 'قام :sender_name بمتابعتك',
        ],
    ],

    'chat' => [
        'deleted_file' => 'الملف المرفق محذوف',
        'file_attached' => 'تم إرفاق ملف',
        'coordinates_were_sent' => 'تم إرسال إحداثيات',
    ],

    // FCM
    'fcm' => [
        'title' => 'تطبيق',
        'new_chat_message' => 'رسالة جديدة',
        'messages' => [
        ],
    ],

    'sms' => [
        'activation_code' => 'كود%20التفعيل%20هو%20:%20:activation_code',
    ],

    'exceptions' => [
        'jwt' => [
            'token_expired_exception' => 'انتهت صلاحية الرمز',
            'token_invalid_exception' => 'الرمز غير صالح',
            'jwt_exception' => 'لم تقم بإرسال الرمز',
            'token_unauthorized' => 'رمز غير مصرح به',
        ],
        'not_found_exception' => 'حدث خطأ ما الرجاء التواصل مع الإدارة',
    ],

    'messages' => [
        'please_complete_the_data' => 'يرجى إكمال البيانات',
        'success_login' => 'تم تسجيل الدخول بنجاح',
        'failed_login' => 'بيانات تسجيل دخول خاطئة',
        'failed_data' => 'البيانات المدخلة غير صحيحة',
        'not_approved_message' => 'لم تقم الإدارة بتأكيد بياناتك بعد',
        'banned_message' => 'تم حظرك من قبل الادارة',
        'deactivation_message' => 'لم تقوم بتفعيل جوالك حتى الان',
        'success_register' => 'تم التسجيل بنجاح',
        'success_logout' => 'تم تسجيل الخروج بنجاح',
        'added_successfully' => 'تمت الإضافة بنجاح',
        'updated_successfully' => 'تمت التعديل بنجاح',
        'deleted_successfully' => 'تم الحذف بنجاح',
        'hidden_successfully' => 'تم الإخفاء بنجاح',
        'has_already_been_deleted' => 'تم الحذف من قبل',
        'activated_successfully' => 'تم التفعيل بنجاح',
        'sent_successfully' => 'تم الارسال بنجاح',
        'has_already_been_submitted' => 'تم الارسال من قبل',
        'sent_code_successfully' => 'تم إرسال الكود بنجاح',
        'not_allowed_to_modify' => 'غير مسموح لك بتعديل البيانات',
        'not_allowed_to_send' => 'غير مسموح لك بالإرسال',
        'not_allowed_to_delete' => 'غير مسموح لك بحذف البيانات',
        'not_allowed_to_view' => 'غير مسموح لك بمشاهدة البيانات',
        'something_went_wrong_please_try_again' => 'حدث خطأ ما. أعد المحاولة من فضلك',
        'password_not_match' => 'كلمة المرور غير متطابقة',
        'code_message' => 'كود التحقق الخاص بك هو ',
        'you_are_already_active' => 'تم التفعيل مسبقا',
        'wrong_code_please_try_again' => 'كود التحقق خطأ. من فضلك تأكد من كود التحقق',
        'post_has_not_reached_the_required_threshold_for_posting_on_findly' => 'لم يصل المنشور إلى العدد المطلوب من الإعجابات للنشر في findly',

        'monthly_subscription_is_not_currently_available' => 'الاشتراك الشهري غير متوفر حاليا',
        'you_cannot_change_the_subscription_when_the_previous_package_subscription_ends' => 'لا يمكنك تغيير الاشتراك الا عند انتهاء اشتراك الباقة السابقة',
        'successful_subscription' => 'تم الإشتراك بنجاح',
    ],
];
