<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Smarthome extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('smarthome',
			function(blueprint $table)
			{
				$table->increments('id');
				$table->date('day');
				$table->time('time');
				$table->string('activity');
				$table->string('condition');
				$table->string('location');
				$table->timestamps();
			}
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('smarthome');
	}
}
