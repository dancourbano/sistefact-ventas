<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMovementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movement', function(Blueprint $table)
		{
			$table->integer('movementId')->primary();
			$table->decimal('quantity', 12)->nullable();
			$table->integer('type')->nullable();
			$table->string('descryption', 225);
			$table->string('concept', 245);
			$table->string('sender', 145);
			$table->string('comprobanteNumber', 45)->nullable();
			$table->integer('createdBy')->nullable();
			$table->dateTime('createdDate')->nullable();
			$table->integer('modifiedBy')->nullable();
			$table->dateTime('modifiedDate')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('movement');
	}

}
