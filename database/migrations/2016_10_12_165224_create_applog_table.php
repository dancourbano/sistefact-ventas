<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('applog', function(Blueprint $table)
		{
			$table->integer('applog')->primary();
			$table->string('description', 45)->nullable();
			$table->dateTime('createdDate')->nullable();
			$table->integer('createdBy')->nullable();
			$table->dateTime('modifiedDate')->nullable();
			$table->integer('modifiedBy')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('applog');
	}

}
