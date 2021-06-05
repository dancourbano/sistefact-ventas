<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone', function(Blueprint $table)
        {
            $table->integer('phoneId', true);
            $table->string('name', 60)->nullable();
            $table->string('phone', 30)->nullable();
            $table->integer('vehicleId')->index('fk_phone_Vehicle_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('phone');
    }

}
