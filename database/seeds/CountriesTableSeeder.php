<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Country::create([
            'ar' => [
                "name" => "المملكة العربية السعودية",
                "currency" => "ريال",
            ],
            'en' => [
                "name" => "Kingdom of Saudi Arabia",
                "currency" => "SAR",
            ],
            'short_name' => 'SA',
            'show_phonecode' => '+966',
            'phonecode' => '966',
            'continent' => 'asia',
        ]);
        App\Models\Country::create([
            'ar' => [
                "name" => "الإمارات العربية المتحدة",
                "currency" => "درهم",
            ],
            'en' => [
                "name" => "United Arab Emirates",
                "currency" => "AED",
            ],
            'short_name' => 'UAE',
            'show_phonecode' => '+971',
            'phonecode' => '971',
            'continent' => 'asia',
        ]);
        App\Models\Country::create([
            'ar' => [
                "name" => "جمهورية مصر العربية",
                "currency" => "جنيه",
            ],
            'en' => [
                "name" => "Egypt",
                "currency" => "EGP",
            ],
            'short_name' => 'EGP',
            'show_phonecode' => '+20',
            'phonecode' => '20',
            'continent' => 'africa',
        ]);
    }
}
