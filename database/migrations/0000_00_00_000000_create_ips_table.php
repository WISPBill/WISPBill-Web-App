<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIpsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ips', function(Blueprint $table)
		{
			$table->integer('id', true)->unsigned();
			$table->integer('address')->unsigned()->unique('ip_address');
			$table->integer('network_id')->unsigned()->nullable();
			$table->integer('device_id')->unsigned()->nullable();
			$table->boolean('used');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ips');
	}

}
