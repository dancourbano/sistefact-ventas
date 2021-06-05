<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPhone extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phone', function(Blueprint $table)
        {
            $table->foreign('vehicleId', 'fk_phone_Vehicle_idx')->references('vehicleId')->on('vehicle')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phone', function(Blueprint $table)
        {
            $table->dropForeign('fk_phone_Vehicle_idx');
        });
    }
}
