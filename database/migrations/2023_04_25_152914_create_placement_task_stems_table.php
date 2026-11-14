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
        Schema::create('placement_task_stems', function (Blueprint $table) {
            $table->id();

	        $table->longText('key_skill')->nullable();
	        $table->longText('plan')->nullable();

	        $table->unsignedBigInteger('placement_task_id');
	        $table->foreign('placement_task_id')->references('id')->on('placement_tasks');

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
        Schema::dropIfExists('placement_task_stems');
    }
};
