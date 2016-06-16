<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomerInfoIdColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('users', 'customer_info_id')) {
        // Nothing
        }else{
            Schema::table('users', function ($table) {
            $table->integer('customer_info_id')->unsigned()->nullable();
            $table->foreign('customer_info_id')->references('id')->on('customer_info')->onDelete('cascade');
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
        Schema::table('users', function ($table) {
        $table->dropColumn('customer_info_id');
        });
    }
}
