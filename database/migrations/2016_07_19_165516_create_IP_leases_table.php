<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIPLeasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create('ip_leases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->ipAddress('ip');
            $table->macAddress('mac');
            $table->boolean('static');
            $table->timestamp('expires')->nullable();
            $table->integer('server_id')->unsigned();
            $table->foreign('server_id')->references('id')->on('dhcp_servers')->onDelete('cascade');
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
           Schema::drop('ip_leases');
    }
}
