<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observation_details', function (Blueprint $table) {

            $table->id();

			$table->text('activity')->nullable();
			$table->text('response')->nullable();

			$table->unsignedBigInteger('observation_step_id');
	        $table->foreign('observation_step_id')->references('id')->on('observation_steps');

	        $table->unsignedBigInteger('observation_id');
	        $table->foreign('observation_id')->references('id')->on('observations');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observation_details');
    }
}
