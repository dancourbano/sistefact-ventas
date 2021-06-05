<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer', function(Blueprint $table)
		{
			$table->integer('customerId', true);
			$table->string('name', 65);
			$table->string('lastName', 65);
			$table->string('identification', 15);
			$table->string('address', 85)->nullable();
			$table->string('city', 45)->nullable();
			$table->string('email', 95)->nullable();
			$table->string('phone1', 25)->nullable();
			$table->string('phone2', 25)->nullable();
			$table->integer('createdBy')->nullable();
			$table->integer('modifiedBy')->nullable();
			$table->dateTime('createdDate')->nullable();
			$table->dateTime('modifiedDate')->nullable();
			$table->date('birthday')->nullable();
			$table->integer('type')->nullable();
			$table->string('maritalStatus', 2)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('customer');
	}

}
