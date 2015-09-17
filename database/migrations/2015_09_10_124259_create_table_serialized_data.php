<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSerializedData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('serialized_data', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data_recorded');
            $table->binary('air_temp')->nullable();
            $table->binary('bar_press')->nullable();
            $table->binary('wind_speed')->nullable();
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
        Schema::drop('serialized_data');
    }
}
