<?php

use Illuminate\Database\Seeder;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('color')->insert([
        	'color_name' => 'Amarillo',
        	'created_at' => new DateTime()
        ]);

        DB::table('color')->insert([
        	'color_name' => 'Azul',
        	'created_at' => new DateTime()
        ]);

		DB::table('color')->insert([
        	'color_name' => 'Blanco',
        	'created_at' => new DateTime()
        ]);

		DB::table('color')->insert([
        	'color_name' => 'Cafe',
        	'created_at' => new DateTime()
        ]);

		DB::table('color')->insert([
        	'color_name' => 'Gris',
        	'created_at' => new DateTime()
        ]);

		DB::table('color')->insert([
        	'color_name' => 'Morado',
        	'created_at' => new DateTime()
        ]);

		DB::table('color')->insert([
        	'color_name' => 'Naranja',
        	'created_at' => new DateTime()
        ]);

        DB::table('color')->insert([
        	'color_name' => 'Negro',
        	'created_at' => new DateTime()
        ]);

        DB::table('color')->insert([
        	'color_name' => 'Rojo',
        	'created_at' => new DateTime()
        ]);

        DB::table('color')->insert([
        	'color_name' => 'Verde',
        	'created_at' => new DateTime()
        ]);        
    }
}
