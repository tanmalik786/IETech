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
        Schema::create('shadow_form_details', function (Blueprint $table) {
            $table->id();

	        $table->text('activity')->nullable();
	        $table->text('response')->nullable();

	        $table->unsignedBigInteger('observation_step_id');
	        $table->foreign('observation_step_id')->references('id')->on('observation_steps');

	        $table->unsignedBigInteger('shadow_form_id');
	        $table->foreign('shadow_form_id')->references('id')->on('shadow_forms');

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
        Schema::dropIfExists('shadow_form_details');
    }
};
