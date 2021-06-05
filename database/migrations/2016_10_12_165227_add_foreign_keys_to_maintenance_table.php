<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMaintenanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('maintenance', function(Blueprint $table)
		{
			$table->foreign('vehicleId', 'fk_maintenance_vehicle1')->references('vehicleId')->on('vehicle')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('maintenance', function(Blueprint $table)
		{
			$table->dropForeign('fk_maintenance_vehicle1');
		});
	}

}
