<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FirstMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrator', function (Blueprint $table) {
            $table->increments('administrator_id');
            $table->string('administrator_username');
            $table->string('password_hash');
            $table->string('administrator_first_name');
            $table->string('administrator_last_name');
            $table->timestamps();
        });

        Schema::create('brand', function (Blueprint $table) {
            $table->increments('brand_id');
            $table->string('brand_name');
            $table->timestamps();
        });

        Schema::create('color', function (Blueprint $table) {
            $table->increments('color_id');
            $table->string('color_name');
            $table->timestamps();
        });

        Schema::create('vehicle_type', function (Blueprint $table) {
            $table->increments('vehicle_type_id');
            $table->string('vehicle_type_name');
            $table->timestamps();
        });

        Schema::create('parking', function (Blueprint $table) {
            $table->increments('parking_id');
            $table->string('parking_username');
            $table->string('nit');
            $table->string('phone_number');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('address');
            $table->integer('administrator_id')->unsigned();

            $table->foreign('administrator_id')->references('administrator_id')->on('administrator');

            $table->timestamps();
        });

        Schema::create('vehicle', function (Blueprint $table) {
            $table->increments('vehicle_id');
            $table->string('last_digit');
            $table->integer('color_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('vehicle_type_id')->unsigned();

            $table->foreign('color_id')->references('color_id')->on('color');
            $table->foreign('brand_id')->references('brand_id')->on('brand');
            $table->foreign('user_id')->references('user_id')->on('user');
            $table->foreign('vehicle_type_id')->references('vehicle_type_id')->on('vehicle_type');

            $table->timestamps();
        });

        Schema::create('slot', function (Blueprint $table) {
            $table->increments('slot_id');
            $table->integer('slot_number');
            $table->integer('vehicle_id')->unsigned();
            $table->integer('parking_id')->unsigned();

            $table->foreign('vehicle_id')->references('vehicle_id')->on('vehicle');
            $table->foreign('parking_id')->references('parking_id')->on('parking');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slot');
        Schema::dropIfExists('parking');
        Schema::dropIfExists('vehicle');
        Schema::dropIfExists('administrator');
        Schema::dropIfExists('brand');
        Schema::dropIfExists('color');
        Schema::dropIfExists('vehicle_type');

    }
}
