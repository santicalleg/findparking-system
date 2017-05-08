<?php

use Illuminate\Database\Seeder;

class VehicleTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicle_type')->insert([
        	'vehicle_type_name' => 'Carro',
            'created_at' => new DateTime()
        ]);

        DB::table('vehicle_type')->insert([
        	'vehicle_type_name' => 'Moto',
            'created_at' => new DateTime()
        ]);
    }
}
