<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBillingIdColumnToCustomerInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('customer_info', 'billing_id')) {
        // Nothing
        }else{
            Schema::table('customer_info', function ($table) {
             $table->string('billing_id')->nullable();
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
        $table->dropColumn('billing_id');
        });
    }
}
