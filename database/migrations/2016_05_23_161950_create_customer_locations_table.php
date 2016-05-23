<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('longitude', 10, 7);
            $table->decimal('latitude', 10, 7);
            $table->string('add');
            $table->string('city');
            $table->integer('zip')->unsigned();
            $table->string('state');
            $table->tinyInteger('status')->nullable();
            $table->integer('customer_info_id')->unsigned();
            $table->foreign('customer_info_id')->references('id')->on('customer_info')->onDelete('cascade');
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
        Schema::drop('customer_locations');
    }
}
