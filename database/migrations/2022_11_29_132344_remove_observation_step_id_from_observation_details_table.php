<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveObservationStepIdFromObservationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('observation_details', function (Blueprint $table) {
            $table->dropForeign('observation_details_observation_step_id_foreign');
            $table->dropColumn('observation_step_id');
			$table->string('step');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('observation_details', function (Blueprint $table) {
            //
        });
    }
}
