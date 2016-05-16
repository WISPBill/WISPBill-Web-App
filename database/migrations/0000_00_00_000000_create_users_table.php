<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->integer('id', true)->unsigned();
			$table->string('name', 60);
			$table->string('first_name', 30);
			$table->string('last_name', 30);
			$table->string('business_name', 40);
			$table->string('billing_street_address_1', 50);
			$table->string('billing_street_address_2', 50);
			$table->string('billing_city', 50);
			$table->string('billing_state', 2);
			$table->string('billing_zip', 5);
            $table->integer('payment_type_id')->unsigned()->nullable();
			$table->string('email', 254)->unique();
			$table->string('phone_1', 14);
			$table->string('phone_2', 14);
			$table->text('notes');
            $table->boolean('active')->default(1);
            $table->string('password', 60);
            $table->rememberToken();
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
		Schema::drop('users');
	}

}
