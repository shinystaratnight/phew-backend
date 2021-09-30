<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            ['key' => 'dashboard_name_ar', 'value' => 'لوحة تحكم تطبيق فيو', 'created_at' => now(), ],
            ['key' => 'dashboard_name_en', 'value' => 'Phew App Dashboard', 'created_at' => now(), ],
            ['key' => 'project_name_ar', 'value' => 'تطبيق فيو', 'created_at' => now(), ],
            ['key' => 'project_name_en', 'value' => 'Phew App', 'created_at' => now(), ],
            ['key' => 'app_lang', 'value' => 'ar', 'created_at' => now(), ],
            ['key' => 'mobile', 'value' => '966547855230', 'created_at' => now(), ],
            ['key' => 'email', 'value' => 'info@phew.com', 'created_at' => now(), ],
            ['key' => 'facebook_url', 'value' => 'https://www.facebook.com/', 'created_at' => now(), ],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/', 'created_at' => now(), ],
            ['key' => 'youtube_url', 'value' => 'https://www.youtube.com/', 'created_at' => now(), ],
            ['key' => 'instagram_url', 'value' => 'https://www.instagram.com/', 'created_at' => now(), ],
            ['key' => 'whatsapp_phone', 'value' => '96653545230', 'created_at' => now(), ],

            ['key' => 'email_host', 'value' => '', 'created_at' => now(), ],
            ['key' => 'email_driver', 'value' => '', 'created_at' => now(), ],
            ['key' => 'email_port', 'value' => '', 'created_at' => now(), ],
            ['key' => 'email_username', 'value' => '', 'created_at' => now(), ],
            ['key' => 'email_password', 'value' => '', 'created_at' => now(), ],
            ['key' => 'email_encrypt', 'value' => '', 'created_at' => now(), ],
            ['key' => 'email_from_address', 'value' => '', 'created_at' => now(), ],
            ['key' => 'email_from_name', 'value' => '', 'created_at' => now(), ],

            ['key' => 'fcm_sender_id', 'value' => '', 'created_at' => now(), ],
            ['key' => 'fcm_server_key', 'value' => '', 'created_at' => now(), ],

            ['key' => 'sms_type', 'value' => '', 'created_at' => now(), ],
            ['key' => 'sms_username', 'value' => '', 'created_at' => now(), ],
            ['key' => 'sms_username', 'value' => '', 'created_at' => now(), ],
            ['key' => 'sms_password', 'value' => '', 'created_at' => now(), ],
            ['key' => 'sms_sender', 'value' => '', 'created_at' => now(), ],

            ['key' => 'distance_search', 'value' => '10', 'created_at' => now(), ],
            ['key' => 'google_map_key', 'value' => 'AIzaSyDdCP49XcVxRLuY-4CYtxHXxnqcDvQLE8', 'created_at' => now(), ],

            ['key' => 'total_interaction_on_post_to_be_displayed_in_findly', 'value' => '3', 'created_at' => now(), ],
            ['key' => 'limit_of_emojis_to_publish_on_findly', 'value' => '10', 'created_at' => now(), ],
            ['key' => 'duration_of_the_post_for_normal_user_in_findly_by_hours', 'value' => '12', 'created_at' => now(), ],
            ['key' => 'duration_of_the_post_for_premium_user_in_findly_by_hours', 'value' => '48', 'created_at' => now(), ],

            ['key' => 'copy_write_ar', 'value' => 'جميع الحقوق محفوظة لتطبيق فيو', 'created_at' => now(), ],
            ['key' => 'copy_write_en', 'value' => 'All rights reserved for Phew App', 'created_at' => now(), ],
            ['key' => 'about_ar', 'value' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء.', 'created_at' => now(), ],
            ['key' => 'about_en', 'value' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which do not look even slightly believable.', 'created_at' => now(), ],
            ['key' => 'conditions_terms_ar', 'value' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء.', 'created_at' => now(), ],
            ['key' => 'conditions_terms_en', 'value' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which do not look even slightly believable.', 'created_at' => now(), ],

            ['key' => 'url_echo', 'value' => 'http://phew.orabi.rmal.com.sa:6001', 'created_at' => now(), ],
            ['key' => 'echo_app_id', 'value' => '5e125b67cc03e2f7', 'created_at' => now(), ],
            ['key' => 'echo_auth_key', 'value' => '00be63a87d50c753484eb5f4541a504a', 'created_at' => now(), ],
        ]);
    }
}
