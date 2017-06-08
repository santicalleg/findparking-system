<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('rating', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('value');
            $table->string('comment')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('parking_id')->unsigned();
            
            $table->foreign('user_id')->references('id')->on('user');            
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
        //
        Schema::dropIfExists('rating');
    }
}
