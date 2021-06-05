<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDetailmaintenanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('detailmaintenance', function(Blueprint $table)
		{
			$table->foreign('vehicleId', 'fk_detailmaintenance_vehicle1')->references('vehicleId')->on('vehicle')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detailmaintenance', function(Blueprint $table)
		{
			$table->dropForeign('fk_detailmaintenance_vehicle1');
		});
	}

}
