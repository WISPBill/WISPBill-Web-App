<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicePortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_ports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('readable_name')->nullable();
            $table->string('name');
            $table->macAddress('mac');
            $table->integer('device_id')->unsigned()->nullable();
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
        Schema::drop('device_ports');
    }
}
