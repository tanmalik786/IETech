<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachingLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teaching_logs', function (Blueprint $table) {

            $table->id();
			$table->text('week_beginning')->nullable();
			$table->text('description')->nullable();
			$table->text('hours_of_contact_time')->nullable();

			$table->unsignedBigInteger('post_id');
	        $table->foreign('post_id')->references('id')->on('posts');

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
        Schema::dropIfExists('teaching_logs');
    }
}
