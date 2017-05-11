<?php

use findparking\Brand;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //factory(Brand::class)->times(100)->create();

        DB::table('brand')->insert([
            'brand_name' => 'Audi',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'BMW',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Chevrolet',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Daihatsu',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Dodge',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Fiat',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Ford',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Honda',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Hyundai',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Jeep',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Kia',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Mazda',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Mercedez Benz',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Mini',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Mitsubishi',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Nissan',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Peugeot',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Porsche',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Renault',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Seat',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Skoda',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'SsangYong',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Subaru',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Toyota',
            'created_at' => new DateTime()
        ]);

        DB::table('brand')->insert([
            'brand_name' => 'Volkswagen',
            'created_at' => new DateTime()
        ]);
    }
}
