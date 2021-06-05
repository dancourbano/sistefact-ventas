<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetailmaintenanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detailmaintenance', function(Blueprint $table)
		{
			$table->integer('detailmaintenanceId')->primary();
			$table->string('latches', 45)->nullable();
			$table->string('panic', 45)->nullable();
			$table->string('claxon', 45)->nullable();
			$table->string('onOff', 45)->nullable();
			$table->string('microphone', 45)->nullable();
			$table->text('detaiil', 65535)->nullable();
			$table->integer('createdBy')->nullable();
			$table->dateTime('createdDate')->nullable();
			$table->integer('modifiedBy')->nullable();
			$table->dateTime('modifiedDate')->nullable();
			$table->integer('vehicleId')->index('fk_detailmaintenance_vehicle1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('detailmaintenance');
	}

}
