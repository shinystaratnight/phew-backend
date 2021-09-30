<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Role::create([
            'plan' => '*',
            'ar' => [
                "name" => "مدير عام",
            ],
            'en' => [
                "name" => "Super Admin",
            ],
        ]);
    }
}
