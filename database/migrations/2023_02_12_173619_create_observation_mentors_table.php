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
        Schema::create('observation_mentors', function (Blueprint $table) {
            $table->id();
	        $table->unsignedBigInteger('observer_id')->nullable();
	        $table->unsignedBigInteger('observed_id')->nullable();
	        $table->unsignedBigInteger('user_id')->nullable();
	        $table->unsignedBigInteger('observation_id')->nullable();
	        $table->string('course_year')->nullable();
	        $table->string('observed_course')->nullable();
	        $table->string('strength')->nullable();
	        $table->string('organization')->nullable();

	        $table->date('date')->nullable();
            $table->timestamps();

	        $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onDelete('SET NULL');
	        $table->foreign( 'observation_id' )->references( 'id' )->on( 'observations' )->onDelete('SET NULL');
	        $table->foreign( 'observer_id' )->references( 'id' )->on( 'users' )->onDelete('SET NULL');
	        $table->foreign( 'observed_id' )->references( 'id' )->on( 'users' )->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observation_mentors');
    }
};
