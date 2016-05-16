<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_locations', function(Blueprint $table)
		{
			$table->integer('id', true)->unsigned();
                        $table->integer('user_id')->unsigned();
			$table->string('business_name', 40);
			$table->string('street_address_1', 50);
			$table->string('street_address_2', 50);
			$table->string('city', 50);
			$table->string('state', 2);
			$table->string('zip', 5);
			$table->date('install_date')->nullable();
			$table->date('termination_date')->nullable();
			$table->text('notes');
			$table->integer('service_id')->unsigned()->nullable();
			$table->integer('company_id')->unsigned()->nullable();
                        $table->boolean('active')->default(1);
			$table->boolean('blocked')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('service_locations');
	}

}
