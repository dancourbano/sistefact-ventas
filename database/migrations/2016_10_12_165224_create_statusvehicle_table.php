<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatusvehicleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('statusvehicle', function(Blueprint $table)
		{
			$table->integer('statusvehicleId')->primary();
			$table->dateTime('lowdate');
			$table->text('description', 65535);
			$table->dateTime('dischargeDate')->nullable();
			$table->integer('vehicleId')->index('fk_statusvehicle_vehicle1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('statusvehicle');
	}

}
