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
        Schema::create('expert_observation_details', function (Blueprint $table) {
            $table->id();
	        $table->text('activity')->nullable();
	        $table->text('response')->nullable();
	        $table->unsignedBigInteger('expert_observation_id');
	        $table->foreign('expert_observation_id')->references('id')->on('expert_observations');
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
        Schema::dropIfExists('expert_observation_details');
    }
};
