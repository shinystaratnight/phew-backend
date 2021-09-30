<?php

use Illuminate\Database\Seeder;

class NationalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Nationality::create([
            'ar' => [
                "name" => "سعودي",
            ],
            'en' => [
                "name" => "Saudi",
            ],
        ]);
        App\Models\Nationality::create([
            'ar' => [
                "name" => "إماراتي",
            ],
            'en' => [
                "name" => "Emirates",
            ],
        ]);
        App\Models\Nationality::create([
            'ar' => [
                "name" => "مصري",
            ],
            'en' => [
                "name" => "Egyptian",
            ],
        ]);
    }
}
