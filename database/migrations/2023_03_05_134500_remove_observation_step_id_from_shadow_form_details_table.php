<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shadow_form_details', function (Blueprint $table) {
	        $table->dropForeign('shadow_form_details_observation_step_id_foreign');
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
        Schema::table('shadow_form_details', function (Blueprint $table) {
            //
        });
    }
};
