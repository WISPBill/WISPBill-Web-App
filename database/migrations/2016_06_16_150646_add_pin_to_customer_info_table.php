<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPinToCustomerInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('customer_info', 'pin')) {
        // Nothing
        }else{
            Schema::table('customer_info', function ($table) {
             $table->string('pin')->nullable();
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
         Schema::table('customer_info', function ($table) {
        $table->dropColumn('pin');
        });
    }
}
