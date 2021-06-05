<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCajachicaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cajachica', function(Blueprint $table)
		{
			$table->integer('cajachicaId')->primary();
			$table->decimal('quantity', 12);
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
		Schema::drop('cajachica');
	}

}
