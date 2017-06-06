<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlotVechicleTypeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('slot', function(Blueprint $table) {
            $table->integer('vehicle_type_id')->unsigned()->default(1);
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_type');
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
        Schema::table('slot', function(Blueprint $table) {
            $table->dropColumn('vehicle_type_id');
        });
    }
}
