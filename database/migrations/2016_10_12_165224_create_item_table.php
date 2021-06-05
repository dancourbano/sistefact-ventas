<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item', function(Blueprint $table)
		{
			$table->integer('itemId', true);
			$table->string('descripcion', 125)->nullable();
			$table->decimal('basePrice', 12)->nullable();
			$table->integer('type')->nullable();
			$table->integer('itemNumber')->nullable();
			$table->integer('status')->nullable();
			$table->integer('itemNumCurrent')->nullable();
			$table->integer('historyId')->nullable();
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
		Schema::drop('item');
	}

}
