<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('park', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('vehicle_id')->unsigned();
            $table->integer('parking_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('user');

            $table->foreign('vehicle_id')->references('id')->on('vehicle');

            $table->foreign('parking_id')->references('id')->on('parking');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('park');
    }
}
