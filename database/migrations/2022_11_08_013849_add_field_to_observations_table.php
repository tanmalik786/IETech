<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToObservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('observations', function (Blueprint $table) {
	        $table->string('teacher_observed')->nullable();
	        $table->string('organization')->nullable();
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
        Schema::table('observations', function (Blueprint $table) {
            //
        });
    }
}
