<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('PM1');
            $table->integer('PM25');
            $table->integer('PM10');
            $table->integer('AveragePM1');
            $table->integer('AveragePM25');
            $table->integer('AveragePM10');
            $table->float('Temperature');
            $table->float('Humidity');
            $table->string('IJPDescription');
            $table->string('IJPString');

            $table->bigInteger('device_id')->unsigned();
            $table->foreign('device_id')->references('id')->on('devices');

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
        Schema::dropIfExists('measurements');
    }
}
