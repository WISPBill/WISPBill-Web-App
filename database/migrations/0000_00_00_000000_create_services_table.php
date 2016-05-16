<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('services', function(Blueprint $table)
		{
			$table->integer('id', true)->unsigned();
			$table->integer('download_max')->unsigned();
			$table->integer('upload_max')->unsigned();
                        $table->integer('download_limit')->unsigned();
                        $table->integer('upload_limit')->unsigned();
			$table->integer('burst_download_limit')->unsigned();
			$table->integer('burst_upload_limit')->unsigned();
			$table->integer('burst_download_time')->unsigned();
			$table->integer('burst_upload_time')->unsigned();
			$table->integer('burst_download_threshold')->unsigned();
			$table->integer('burst_upload_threshold')->unsigned();
                        $table->integer('price')->unsigned();
			$table->string('service_name', 30);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('services');
	}

}
