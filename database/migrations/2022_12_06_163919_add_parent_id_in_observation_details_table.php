<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdInObservationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('observation_details', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable();
			$table->foreign('parent_id')->references('id')->on('observation_details')->onDelete('SET NULL');
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
