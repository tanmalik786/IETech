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
        Schema::create('expert_observations', function (Blueprint $table) {
            $table->id();
	        $table->unsignedBigInteger('observer_id');
	        $table->unsignedBigInteger('observed_id');
	        $table->unsignedBigInteger('user_id');
	        $table->string('course_year');
	        $table->date('date');

	        $table->foreign( 'observer_id' )->references( 'id' )->on( 'users' );
	        $table->foreign( 'observed_id' )->references( 'id' )->on( 'users' );
	        $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );
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
        Schema::dropIfExists('expert_observations');
    }
};
