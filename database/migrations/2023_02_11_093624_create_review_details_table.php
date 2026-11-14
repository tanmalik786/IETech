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
        Schema::create('review_details', function (Blueprint $table) {
	        $table->id();

	        $table->text('activity')->nullable();
	        $table->text('response')->nullable();

	        $table->string('step');

	        $table->unsignedBigInteger('review_id');
	        $table->foreign('review_id')->references('id')->on('reviews');

	        $table->unsignedBigInteger('parent_id')->nullable();
	        $table->foreign('parent_id')->references('id')->on('review_details')->onDelete('SET NULL');

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
        Schema::dropIfExists('review_details');
    }
};
