<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDriverTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('driver', function(Blueprint $table)
		{
			$table->integer('driverId')->primary();
			$table->string('name', 122);
			$table->string('lastName', 122);
			$table->string('phone', 45);
			$table->integer('createdBy')->nullable();
			$table->dateTime('createdDate')->nullable();
			$table->integer('modifiedBy')->nullable();
			$table->dateTime('modifiedDate')->nullable();
			$table->integer('vehicleId')->index('fk_driver_vehicle1_idx');
			$table->string('address', 225)->nullable();
			$table->string('identification', 8)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('driver');
	}

}
