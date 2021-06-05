<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetailpackageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detailpackage', function(Blueprint $table)
		{
			$table->integer('detailPackageId', true);
			$table->string('basePrice', 45)->nullable();
			$table->string('quantity', 45)->nullable();
			$table->integer('createdBy')->nullable();
			$table->dateTime('createdDate')->nullable();
			$table->integer('modifiedBy')->nullable();
			$table->dateTime('modifiedDate')->nullable();
			$table->integer('itemId')->index('fk_detailPackage_item_idx');
			$table->integer('packageId')->index('fk_detailPackage_package1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('detailpackage');
	}

}
