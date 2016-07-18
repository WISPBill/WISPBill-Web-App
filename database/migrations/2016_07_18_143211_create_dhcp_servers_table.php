<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDhcpServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dhcp_servers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('subnet');
            $table->integer('lease');
            $table->integer('leased')->nullable();
            $table->ipAddress('start');
            $table->ipAddress('stop');
            $table->ipAddress('router');
            $table->ipAddress('dns1')->nullable();
            $table->ipAddress('dns2')->nullable();
            $table->integer('device_id')->unsigned();
            $table->foreign('device_id')->references('id')->on('Devices')->onDelete('cascade');
            $table->integer('port_id')->unsigned()->nullable();
            $table->foreign('port_id')->references('id')->on('device_ports')->onDelete('cascade');
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
        Schema::drop('dhcp_servers');
    }
}
