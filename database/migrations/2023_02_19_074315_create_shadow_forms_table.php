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
        Schema::create('shadow_forms', function (Blueprint $table) {

            $table->id();
	        $table->string( 'year_group' )->nullable();
	        $table->date( 'date' )->nullable();
	        $table->time( 'time' )->nullable();
	        $table->string( 'ability' )->nullable();
	        $table->string( 'number_of_students' )->default( 0 );
	        $table->string( 'course_title' )->nullable();
	        $table->string( 'topic' )->nullable();
	        $table->string( 'pre_req' )->nullable();
	        $table->string( 'outcome' )->nullable();
	        $table->string( 'number_of_staff' )->default( 0 );

	        $table->unsignedBigInteger( 'user_id' );
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
        Schema::dropIfExists('shadow_forms');
    }
};
