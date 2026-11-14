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
        Schema::create('review_feedback', function (Blueprint $table) {
            $table->id();
			$table->text('feedback')->nullable();
	        $table->unsignedBigInteger('review_id');
	        $table->foreign('review_id')->references('id')->on('reviews');
	        $table->unsignedBigInteger('user_id');
	        $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('review_feedback');
    }
};
