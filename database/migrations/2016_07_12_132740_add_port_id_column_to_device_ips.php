<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPortIdColumnToDeviceIps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('device_IPs', 'port_id')) {
        // Nothing
        }else{
            Schema::table('device_IPs', function ($table) {
             $table->integer('port_id')->unsigned()->nullable();
            $table->foreign('port_id')->references('id')->on('device_ports')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('device_IPs', function ($table) {
        $table->dropColumn('port_id');
        });
    }
}
