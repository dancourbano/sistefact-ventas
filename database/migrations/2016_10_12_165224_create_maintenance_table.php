<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMaintenanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('maintenance', function(Blueprint $table)
		{
			$table->integer('maintenanceId')->primary();
			$table->dateTime('maintenanceDate');
			$table->text('detail', 65535);
			$table->dateTime('createdDate')->nullable();
			$table->dateTime('modifiedDate')->nullable();
			$table->integer('createdBy')->nullable();
			$table->integer('modifiedBy')->nullable();
			$table->integer('vehicleId')->index('fk_maintenance_vehicle1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('maintenance');
	}

}
