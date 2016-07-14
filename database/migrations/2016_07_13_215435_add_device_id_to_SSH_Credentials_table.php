<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeviceIdToSSHCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         if (Schema::hasColumn('SSH_Credentials', 'device_id')) {
        // Nothing
        }else{
            Schema::table('SSH_Credentials', function ($table) {
            $table->integer('device_id')->unsigned()->nullable();
            $table->foreign('device_id')->references('id')->on('Devices')->onDelete('cascade');
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
        Schema::table('SSH_Credentials', function ($table) {
        $table->dropColumn('device_id');
        });
    }
}
