<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('port_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('port_id')->unsigned();
            $table->foreign('port_id')->references('id')->on('device_ports')->onDelete('cascade');
            $table->bigInteger('rx_rate')->unsigned()->nullable();
            $table->bigInteger('tx_rate')->unsigned()->nullable();
            $table->bigInteger('rx_packets')->unsigned();
            $table->bigInteger('tx_packets')->unsigned();
            $table->bigInteger('rx_bytes')->unsigned();
            $table->bigInteger('tx_bytes')->unsigned();
            $table->bigInteger('rx_dropped')->unsigned();
            $table->bigInteger('tx_dropped')->unsigned();
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
        Schema::drop('port_data');
    }
}
