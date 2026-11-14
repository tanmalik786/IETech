<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToObservationStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('observation_steps', function (Blueprint $table) {
	        $table->unsignedBigInteger('observation_type_id')->nullable();
	        $table->foreign('observation_type_id')->references('id')->on('observation_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('observation_steps', function (Blueprint $table) {
            //
        });
    }
}
