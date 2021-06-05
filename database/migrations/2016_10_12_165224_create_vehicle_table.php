<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVehicleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vehicle', function(Blueprint $table)
		{
			$table->integer('vehicleId', true);
			$table->string('placa', 12);
			$table->string('sn', 45);
			$table->string('shortNumber', 45);
			$table->string('motorNumber', 45)->nullable();
			$table->string('year', 4)->nullable();
			$table->string('brandCar', 45)->nullable();
			$table->string('modelClass', 125)->nullable();
			$table->string('chasisSerie', 122)->nullable();
			$table->dateTime('registerDate');
			$table->string('comment', 125)->nullable();
			$table->string('classCar', 125)->nullable();
			$table->string('internalNumber', 65)->nullable();
			$table->integer('status')->nullable();
			$table->string('telMov', 45)->nullable();
			$table->string('telCla', 45)->nullable();
			$table->string('telEmergency', 45)->nullable();
			$table->integer('createdBy')->nullable();
			$table->dateTime('createdDate')->nullable();
			$table->integer('modifiedBy')->nullable();
			$table->dateTime('modifiedDate')->nullable();
			$table->string('sim', 20)->nullable();
			$table->string('gpsId', 20)->nullable();
			$table->string('mg', 45)->nullable();
			$table->string('mandated',125)->nullable();
			$table->string('personTelEmergency', 125)->nullable();
			$table->string('brandDevice', 45)->nullable();
			$table->string('notInformationCel', 45)->nullable();
			$table->string('notInformationName', 145)->nullable();
			$table->string('parkingplace', 205)->nullable();
            $table->integer('historyId')->nullable();
			$table->integer('customerId')->index('fk_vehicle_customer1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vehicle');
	}

}
