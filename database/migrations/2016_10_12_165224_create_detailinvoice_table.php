<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetailinvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detailinvoice', function(Blueprint $table)
		{
			$table->increments('detailinvoiceId');
			$table->decimal('price', 12)->nullable();
			$table->integer('status')->nullable();
			$table->integer('quantity')->nullable();
			$table->string('description', 225)->nullable();
			$table->integer('invoiceId')->index('fk_detailinvoice_invoice1_idx');
			$table->integer('packageId')->nullable();
			$table->integer('itemId')->nullable();
			$table->integer('vehicleId')->nullable();
		});

        DB::unprepared('ALTER TABLE `detailinvoice` DROP PRIMARY KEY, ADD PRIMARY KEY ( `detailinvoiceId` )');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('detailinvoice');
	}

}
