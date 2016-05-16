<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTowersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('towers', function(Blueprint $table)
		{
			$table->integer('id', true)->unsigned();
                        $table->string('name', 50);
			$table->string('street_address_1', 50);
			$table->string('street_address_2', 50);
			$table->string('city', 50);
			$table->string('state', 2);
			$table->string('zip', 5);
			$table->integer('user_id')->unsigned()->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('towers');
	}

}
