<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employee', function(Blueprint $table)
		{
			$table->integer('employeeId')->primary();
			$table->string('name', 125);
			$table->string('lastName', 125);
			$table->string('address', 225)->nullable();
			$table->string('avatar', 225)->nullable();
			$table->string('phone', 25)->nullable();
			$table->string('role', 45)->nullable();
			$table->date('birthday')->nullable();
			$table->integer('userId')->index('fk_employee_user1_idx');
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
		Schema::drop('employee');
	}

}
