<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVehicleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('vehicle', function(Blueprint $table)
		{
			$table->foreign('customerId', 'fk_vehicle_customer1')->references('customerId')->on('customer')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('vehicle', function(Blueprint $table)
		{
			$table->dropForeign('fk_vehicle_customer1');
		});
	}

}
