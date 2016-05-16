<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoutersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('routers', function(Blueprint $table)
		{
			$table->integer('id', true)->unsigned();
			$table->string('mfg', 20);
                        $table->string('model', 50);
                        $table->integer('total')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('routers');
	}

}
