<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMenuRoleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('menu_role', function(Blueprint $table)
		{
			$table->foreign('menu_id')->references('id')->on('menus')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('role_id')->references('id')->on('roles')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('menu_role', function(Blueprint $table)
		{
			$table->dropForeign('menu_role_menu_id_foreign');
			$table->dropForeign('menu_role_role_id_foreign');
		});
	}

}
