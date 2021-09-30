<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'fullname' => 'Abdallah Orabi',
                'mobile' => '9961023624205',
                'email' => 'abd.asaad1994@gmail.com',
                'password' => bcrypt('123456789'),
                'type' => 'superadmin',
                'is_active' => true,
                'role_id' => 1,
                'email_verified_at' => now(),
                'created_at' => now(),
            ]
        ]);
    }
}
