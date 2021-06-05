<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePackageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('package', function(Blueprint $table)
		{
			$table->integer('packageId', true);
			$table->string('name', 45)->nullable();
			$table->decimal('basePrice', 12)->nullable();
			$table->integer('createdBy')->nullable();
			$table->dateTime('createdDate')->nullable();
			$table->dateTime('ModifiedDate')->nullable();
			$table->integer('ModifiedBy')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('package');
	}

}
