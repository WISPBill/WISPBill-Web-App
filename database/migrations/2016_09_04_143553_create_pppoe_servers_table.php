<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePppoeServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('pppoe_servers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->ipAddress('start');
            $table->ipAddress('stop');
            $table->ipAddress('radius');
            $table->ipAddress('dns1')->nullable();
            $table->ipAddress('dns2')->nullable();
            $table->integer('device_id')->unsigned();
            $table->foreign('device_id')->references('id')->on('Devices')->onDelete('cascade');
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
        Schema::drop('pppoe_servers');
    }
}
