<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDeviceIps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('device_IPs', function (Blueprint $table) {
            $table->increments('id');
            $table->ipAddress('address');
            $table->integer('network_id')->unsigned();
            $table->foreign('network_id')->references('id')->on('networks')->onDelete('cascade');
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
              Schema::drop('device_IPs');
    }
}
