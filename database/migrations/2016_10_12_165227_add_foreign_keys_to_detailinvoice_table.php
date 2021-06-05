<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDetailinvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('detailinvoice', function(Blueprint $table)
		{
			$table->foreign('invoiceId', 'fk_detailinvoice_invoice1')->references('invoiceId')->on('invoice')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('detailinvoice', function(Blueprint $table)
		{
			$table->dropForeign('fk_detailinvoice_invoice1');
		});
	}

}
