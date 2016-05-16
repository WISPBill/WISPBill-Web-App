<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsageRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usage_records', function(Blueprint $table)
		{
			$table->integer('id', true)->unsigned();;
			$table->integer('device_id')->unsigned();
			$table->bigInteger('in_bytes')->unsigned();
			$table->bigInteger('out_bytes')->unsigned();
			$table->date('date');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usage_records');
	}

}
