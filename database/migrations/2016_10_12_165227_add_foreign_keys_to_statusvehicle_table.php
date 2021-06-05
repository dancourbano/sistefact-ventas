<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToStatusvehicleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('statusvehicle', function(Blueprint $table)
		{
			$table->foreign('vehicleId', 'fk_statusvehicle_vehicle1')->references('vehicleId')->on('vehicle')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('statusvehicle', function(Blueprint $table)
		{
			$table->dropForeign('fk_statusvehicle_vehicle1');
		});
	}

}
