<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservationRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observation_remarks', function (Blueprint $table) {
            $table->id();
			$table->text('remarks');
			$table->unsignedBigInteger('observation_id');
			$table->foreign('observation_id')->references('id')->on('observations')->onDelete('CASCADE');
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
        Schema::dropIfExists('observation_remarks');
    }
}
