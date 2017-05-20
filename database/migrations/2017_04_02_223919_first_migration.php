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
            $table->increments('id');
            $table->string('name');
            $table->string('administrator_first_name');
            $table->string('administrator_last_name');
            $table->string('email')->index();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('brand', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand_name');
            $table->timestamps();
        });

        Schema::create('color', function (Blueprint $table) {
            $table->increments('id');
            $table->string('color_name');
            $table->timestamps();
        });

        Schema::create('vehicle_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vehicle_type_name');
            $table->timestamps();
        });

        Schema::create('parking', function (Blueprint $table) {
            $table->increments('id');
            $table->string('parking_name');
            $table->string('nit');
            $table->string('phone_number');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('address');
            $table->string('services');
            $table->string('schedule');
            $table->integer('administrator_id')->unsigned();

            $table->foreign('administrator_id')->references('id')->on('administrator');

            $table->timestamps();
        });

        Schema::create('vehicle', function (Blueprint $table) {
            $table->increments('id');
            $table->string('last_digit');
            $table->integer('color_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('vehicle_type_id')->unsigned();

            $table->foreign('color_id')->references('id')->on('color');
            $table->foreign('brand_id')->references('id')->on('brand');
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_type');

            $table->timestamps();
        });

        Schema::create('slot', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slot_name');
            $table->string('vehicle_id')->nullable();
            $table->integer('parking_id')->unsigned();

            $table->foreign('parking_id')->references('id')->on('parking');

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
        Schema::dropIfExists('vehicle');
        Schema::dropIfExists('parking');
        Schema::dropIfExists('vehicle_type');
        Schema::dropIfExists('color');
        Schema::dropIfExists('brand');
        Schema::dropIfExists('administrator');
    }
}
