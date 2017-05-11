<?php

use findparking\Administrator;
use Illuminate\Database\Seeder;

class AdministratorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //factory(Administrator::class)->times(2)->create();

        DB::table('administrator')->insert([
            'administrator_first_name' => 'Administrador', 
            'administrator_last_name' => 'Find',
            'name' => 'admin',
            'email' => 'admin@findparking.com',
            'password' => bcrypt('12345678'),
            'created_at' => new DateTime()
        ]);
    }
}
