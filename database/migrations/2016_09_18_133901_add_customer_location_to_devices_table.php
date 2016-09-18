<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomerLocationToDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('Devices', 'customer_location_id')) {
        // Nothing
        }else{
            Schema::table('Devices', function ($table) {
             $table->integer('customer_location_id')->unsigned()->nullable();
            $table->foreign('customer_location_id')->references('id')->on('customer_locations')->onDelete('cascade');
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
                 Schema::table('Devices', function ($table) {
        $table->dropColumn('customer_location_id');
        });
    }
}
