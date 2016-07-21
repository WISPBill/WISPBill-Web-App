<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRadioDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radio_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('device_id')->unsigned();
            $table->foreign('device_id')->references('id')->on('Devices')->onDelete('cascade');
            $table->double('frequency', 10, 5);
            $table->tinyInteger('txPower');
            $table->smallInteger('signal');
            $table->smallInteger('noise');
            $table->smallInteger('ccq');
            $table->smallInteger('latency');
            $table->timestamps();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('radio_data');
    }
}
