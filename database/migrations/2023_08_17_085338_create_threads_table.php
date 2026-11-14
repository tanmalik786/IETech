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
        Schema::create('threads', function (Blueprint $table) {
	        $table->id();
	        $table->unsignedBigInteger('topic_id');
	        $table->string('title');
	        $table->text('content');
	        $table->text('tags')->nullable();
	        $table->unsignedBigInteger('user_id');
	        $table->tinyInteger('status')->default(1);
	        $table->timestamps();

	        $table->foreign('topic_id')->references('id')->on('topics');
	        $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('threads');
    }
};
