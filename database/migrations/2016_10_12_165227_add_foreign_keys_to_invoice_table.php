<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('invoice', function(Blueprint $table)
		{
			$table->foreign('customerId', 'fk_invoice_Customer1')->references('customerId')->on('customer')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('invoice', function(Blueprint $table)
		{
			$table->dropForeign('fk_invoice_Customer1');
		});
	}

}
