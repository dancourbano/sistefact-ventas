<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDetailpackageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('detailpackage', function(Blueprint $table)
		{
			$table->foreign('itemId', 'fk_detailPackage_item')->references('itemId')->on('item')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('packageId', 'fk_detailPackage_package1')->references('packageId')->on('package')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detailpackage', function(Blueprint $table)
		{
			$table->dropForeign('fk_detailPackage_item');
			$table->dropForeign('fk_detailPackage_package1');
		});
	}

}
