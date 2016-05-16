<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDevicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('devices', function(Blueprint $table)
		{
			$table->integer('id', true)->unsigned();
			$table->integer('service_location_id')->unsigned()->nullable();
			$table->integer('tower_id')->unsigned()->nullable();
			$table->integer('antenna_id')->unsigned()->nullable();
                        $table->integer('radio_card_id')->unsigned()->nullable();
                        $table->integer('router_id')->unsigned()->nullable();
                        $table->integer('poe_id')->unsigned()->nullable();
                        $table->integer('connectorized_radio_id')->unsigned()->nullable();
                        $table->integer('integrated_radio_id')->unsigned()->nullable();
                        $table->string('mac_address', 17);
                        $table->text('notes');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('devices');
	}

}
