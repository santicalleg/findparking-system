<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'first_name' => 'User', 
            'last_name' => 'Find',
            'mobile_number' => '3100000000',
            'name' => 'user',
            'email' => 'user@findparking.com',
            'password' => bcrypt('12345678'),
            'created_at' => new DateTime()
        ]);
    }
}
