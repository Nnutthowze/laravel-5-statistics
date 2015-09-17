<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEnviromentalData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('enviromental_data', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data_recorded');
            $table->text('air_temp')->nullable();
            $table->text('bar_press')->nullable();
            $table->text('wind_speed')->nullable();
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
        Schema::drop('enviromental_data');
    }
}
