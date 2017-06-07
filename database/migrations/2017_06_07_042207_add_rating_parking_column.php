<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRatingParkingColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('parking', function(Blueprint $table) {
            $table->decimal('rating')->default(0);
        });

        Schema::create('user_rating', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('parking_id')->unsigned();
            $table->integer('rating');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('user');
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
        Schema::table('parking', function(Blueprint $table) {
            $table->dropColumn('rating');
        });

        Schema::dropIfExists('user_rating');
    }
}
