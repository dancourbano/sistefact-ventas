<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameDetailColumnInDetailmaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detailmaintenance', function($table){
            $table -> renameColumn('detaiil', 'detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detailmaintenance', function($table){
            $table -> renameColumn('detail', 'detaiil');
        });
    }
}
