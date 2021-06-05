<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice', function(Blueprint $table)
		{
			$table->integer('invoiceId', true);
			$table->string('taxType', 60)->nullable();
			$table->decimal('tax', 12)->nullable();
			$table->decimal('disccountValue', 12)->nullable();
			$table->decimal('subtotal', 12);
			$table->dateTime('datePayMax')->nullable();
			$table->integer('status');
			$table->integer('disccountType')->nullable();
			$table->decimal('total', 12);
            $table->integer('is_sendEmail')->nullable();
            $table->integer('repeatInvoice')->nullable();
			$table->text('notes', 65535)->nullable();
			$table->integer('createdBy')->nullable();
			$table->dateTime('createdDate')->nullable();
			$table->integer('modifiedBy')->nullable();
			$table->dateTime('modifiedDate')->nullable();
			$table->decimal('debt', 12)->nullable();
			$table->integer('methodpayment');
			$table->integer('delayedPaymentDetailInvoiceId')->nullable();
			$table->integer('customerId')->index('fk_invoice_Customer1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('invoice');
	}

}
