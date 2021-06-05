<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEmployeeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('employee', function(Blueprint $table)
		{
			$table->foreign('userId', 'fk_employee_user1')->references('userId')->on('user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('employee', function(Blueprint $table)
		{
			$table->dropForeign('fk_employee_user1');
		});
	}

}
