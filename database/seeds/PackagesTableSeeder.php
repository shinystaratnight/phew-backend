<?php

use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Package::create([
            'ar' => [
                "name" => "الباقة المجانية",
            ],
            'en' => [
                "name" => "Free Package",
            ],
            'package_type' => 'free',
            'period_type' => 'years',
            'period' => '1',
            'price' => '0',
            'plan' => ["characters_post_count" => "300", "profile_images_count" => "3", "friends_count" => "100", "period_to_pin_post_on_findly_by_seconds" => "12", "minimum_period_for_clearing_inactive_accounts_by_days" => "0"],
        ]);
        App\Models\Package::create([
            'ar' => [
                "name" => "الباقة الشهرية",
            ],
            'en' => [
                "name" => "Monthly Package",
            ],
            'package_type' => 'paid',
            'period_type' => 'months',
            'period' => '1',
            'price' => '50',
            'plan' => ["characters_post_count" => "600", "profile_images_count" => "5", "friends_count" => "200", "period_to_pin_post_on_findly_by_seconds" => "48", "minimum_period_for_clearing_inactive_accounts_by_days" => "60"],
        ]);
        App\Models\Package::create([
            'ar' => [
                "name" => "الباقة السنوية",
            ],
            'en' => [
                "name" => "Yearly Package",
            ],
            'package_type' => 'paid',
            'period_type' => 'years',
            'period' => '1',
            'price' => '500',
            'plan' => ["characters_post_count" => "600", "profile_images_count" => "5", "friends_count" => "200", "period_to_pin_post_on_findly_by_seconds" => "48", "minimum_period_for_clearing_inactive_accounts_by_days" => "60"],
        ]);
    }
}
