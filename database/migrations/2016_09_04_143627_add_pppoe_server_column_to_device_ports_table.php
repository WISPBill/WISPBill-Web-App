<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPppoeServerColumnToDevicePortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('device_ports', 'pppoe_server_id')) {
        // Nothing
        }else{
            Schema::table('device_ports', function ($table) {
            $table->integer('pppoe_server_id')->unsigned()->nullable();
            $table->foreign('pppoe_server_id')->references('id')->on('pppoe_servers')->onDelete('cascade');
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
         Schema::table('device_ports', function ($table) {
        $table->dropColumn('pppoe_server_id');
        });
    }
}
