<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\City::create([
            'ar' => [
                "name" => "الرياض",
            ],
            'en' => [
                "name" => "Riyadh",
            ],
            'country_id' => 1
        ]);
        App\Models\City::create([
            'ar' => [
                "name" => "مكة المكرمة",
            ],
            'en' => [
                "name" => "Mecca",
            ],
            'country_id' => 1
        ]);
        App\Models\City::create([
            'ar' => [
                "name" => "جدة",
            ],
            'en' => [
                "name" => "Jeddah",
            ],
            'country_id' => 1
        ]);
        App\Models\City::create([
            'ar' => [
                "name" => "أبوظبي",
            ],
            'en' => [
                "name" => "Abu Dhabi",
            ],
            'country_id' => 2
        ]);
        App\Models\City::create([
            'ar' => [
                "name" => "القاهرة",
            ],
            'en' => [
                "name" => "Cairo",
            ],
            'country_id' => 3
        ]);
    }
}
